<?php

define('SYNC2CY_QUERY_LIMIT',30);
define('SYNC2WP_LOAD_LIMIT',5);
define('SYNC_FINISH_CODE',0);
define('SYNC_CONTINUE_CODE',1);
define('SYNC_ERROR_CODE',3);

ini_set('max_execution_time', '0');
class Changyan_Synchronizer
{
    private static $instance = null;
    private $PluginURL = 'changyan';

    public function __construct()
    {
        $this->PluginURL = plugin_dir_url(__FILE__);
    }

    private function __clone()
    {
        //Prevent from being cloned
    }

    /* return the single instance of this class */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /* format long date type to yy-mm-dd */
    public function timeFormat($time) {
        return date('Y-m-d H:i:s', $time);
    }

    public function simpleJsonResponse($status, $progress, $error=null)
    {
        return json_encode(array('status' => $status, 'progress' => $progress, 'error' => $error));
    }

    /* export comment in local database to Synchronize to Changyan
     * return: json, for example {{status:0}, {progress: cmtid }, {error:'msg'}},
     *  status=0: all finish, status=1: continue, status=3: error
     */
    public function sync2Changyan()
    {
        global $zbp;
        @set_time_limit(0);
        @ini_set('memory_limit', '256M');
        $lastSyncedCmtID = $this->getOption('changyan_lastCmtID2CY');
        if(empty($lastSyncedCmtID)) {
            $lastSyncedCmtID = 0;
        }

        $currentCmtID = $this->getSyncProgress();
        if (empty($currentCmtID) || !is_numeric($currentCmtID)) {
            $currentCmtID = $lastSyncedCmtID;
        }

        $sql = $zbp->db->sql->Select('%pre%comment', '*', array(array('CUSTOM',"comm_ID>" . $currentCmtID . " AND comm_Agent NOT LIKE 'Changyan_%'")), 'comm_ID', SYNC2CY_QUERY_LIMIT, null);
        $commentsList = $zbp->db->Query($sql);
        if(empty($commentsList)) {
            $this->setSyncProgress('success');
            $this->setOption('changyan_lastCmtID2CY',$currentCmtID);
            return $this->simpleJsonResponse(SYNC_FINISH_CODE, $currentCmtID, 'sync finished!');
        }

        $postIDArray = array();
        foreach ($commentsList as $comment) {
            $postIDArray[$comment['comm_LogID']] = $comment['comm_ID'];
        }

        $maxCmtID = 0;
        $topics = array();
        foreach ($postIDArray as $postID=>$cmtID) {
            $maxCmtID = $cmtID;
            $sql = $zbp->db->sql->Select('%pre%post','log_ID AS post_ID, log_Title AS post_title, log_PostTime AS post_time',array(array('CUSTOM',"log_ID = ".$postID)),null,null,null);
            $postInfo = $zbp->db->Query($sql);
            if(empty($postInfo)) continue;
            $topics[] = $this->packageCyanTopic($postInfo[0],$commentsList);
        }

        $success = $this->import2Changyan($topics);
        if($success) {
            $this->setSyncProgress($maxCmtID);
            return $this->simpleJsonResponse(SYNC_CONTINUE_CODE, $maxCmtID);
        } else {
            return $this->simpleJsonResponse(SYNC_ERROR_CODE, $maxCmtID, 'import to changyan error!');
        }
    }

    /*
     * return: 畅言导入的一条Topic(json)
     */
    private function packageCyanTopic($postInfo,$commentsList)
    {
        global $zbp;
        $topicInfo = null;
        //$post=GetPost($postInfo['post_ID']);
        //$topic_url = $post->_get('Url');
        $topic_title = $postInfo['post_title'];
        $topic_time = $postInfo['post_time'];
        $topic_id = $postInfo['post_ID'];
        $topic_source_id = $postInfo['post_ID'];

        $comments = array();
        foreach($commentsList as $cmt) {
            if($postInfo['post_ID'] == $cmt['comm_LogID']) {
                //$zbMember = $zbp->GetMemberByID($cmt['comm_AuthorID']);
                $genUserId = $cmt['comm_Email'].'#'.$cmt['comm_AuthorID'];
                $user = array(
                    'userid' => $genUserId,
                    'nickname' => $cmt['comm_Name'],
                    'usericon' => '',
                    'userurl' => $cmt['comm_HomePage']
                );
                $comments[] = array(
                    'cmtid' => $cmt['comm_ID'],
                    'ctime' => 1000 * $cmt['comm_PostTime'],
                    'content' => $cmt['comm_Content'],
                    'replyid' => $cmt['comm_ParentID'],
                    'user' => $user,
                    'ip' => $cmt['comm_IP'],
                    'useragent' => $cmt['comm_Agent'],
                    'channeltype' => '1',
                    'from' => '',
                    'spcount' => '',
                    'opcount' => ''
                );
            }
        }
        if(!empty($comments)) {
            $topicInfo = array(
                'title' => $topic_title,
                'url' => '',
                'ttime' => $topic_time,
                'sourceid' => $topic_source_id,
                'parentid' => '',
                'categoryid' => '',
                'ownerid' => '',
                'metadata' => '',
                'comments' => $comments
            );
        }
        return $topicInfo;
    }

    /*
     * return: true or false
     */
    private function import2Changyan($topics)
    {
        $appId = $this->getOption('changyan_appId');
        $appKey = $this->getOption('changyan_appKey');
        $appId = trim($appId);
        $appKey = trim($appKey);
        $topicsJson = '';
        foreach($topics as $topic) {
            $topicsJson .= json_encode($topic) . "\n";
        }
        $md5 = hash_hmac('sha1', $topicsJson, $appKey);
        $url = 'http://changyan.sohu.com/admin/api/import/comment';
        $postData = "appid=" . $appId . "&md5=" . $md5 . "&jsondata=" . $topicsJson;

        $client = new ChangYan_Client();
        $response = $client->http_request($url, 'POST', $postData);
        if(isset($response['success'])) {
            return $response['success'];
        }
        return false;
    }

    /* Synchronize comments in changyan to WordPress 
     * return: json, continue sync={"status":1}, finish sync={"status":0}
     */
    public function sync2Zblog()
    {
        global $zbp;
        @set_time_limit(0);
        @ini_set('memory_limit', '256M');

        date_default_timezone_set('Etc/GMT-8');
        $appId = $this->getOption('changyan_appId');
        $lastTime2WP = $this->getOption('changyan_lastTimeSync2WP');

        if(empty($lastTime2WP)) {
            $lastTime2WP = 0;
        }
        $offset = $this->getSyncProgress();
        if (empty($offset) || !is_numeric($offset)) {
            $offset = 0;
        }

        $topics = $this->getRecentFormChangyan($appId, $lastTime2WP, $offset, SYNC2WP_LOAD_LIMIT);
        if(empty($topics)) {
            $this->setSyncProgress('success');
            $this->setOption('changyan_lastTimeSync2WP', time());
            return $this->simpleJsonResponse(SYNC_FINISH_CODE, $offset, 'sync finished!');
        }

        foreach ($topics as $topic) {
            $postComments = $this->getCommentsFromChangYan($appId, $topic);
            $this->insertComments($postComments, $lastTime2WP);
        }
        $offset += SYNC2WP_LOAD_LIMIT;
        $this->setSyncProgress($offset);
        return $this->simpleJsonResponse(SYNC_CONTINUE_CODE, $offset);
    }

    /*
     * return: array of recent commented topics infos, null or array: array('topic_id'=>id, 'topic_url'=>url, 'topic_title'=>title)
     */
    private function getRecentFormChangyan($appId, $time, $offset=0, $limit=50)
    {
        $topics = null;
        $sum = 0;
        date_default_timezone_set('Etc/GMT-8');
        $params = array(
            'appId' => $appId,
            'date' => date('Y-m-d H:i:s', $time)
        );
        $url = "http://changyan.sohu.com/admin/api/recent-comment-topics";
        $client = new ChangYan_Client();
        $response = $client->http_request($url, 'GET', $params);
        if(isset($response)) {
            if( $response['success'] == true && is_array($response['topics']) ) {
                $sum = count($response['topics']);
                $topics = array_slice($response['topics'], $offset, $limit);
            } else {
                $topics = null;
            }
        }
        return $topics;
    }

    /*
     * $appid:
     * $topic:  = array('topic_id'=>id, 'topic_url'=>url, 'topic_title'=>title)
     * $return:  null or array('postId'=>id, 'comments'=>array)
     */
    private function getCommentsFromChangYan($appId, $topic)
    {
        if(!isset($appId) || !isset($topic)) {
            return null;
        }
        $params = array(
            'client_id' => $appId,
            'topic_id' => $topic['topic_id'],
            'page_no'=>1,
            'page_size'=>100,
            'order_by'=>'time_desc'
        );
        $url = 'http://changyan.sohu.com/api/2/topic/comments';

        $client = new ChangYan_Client();
        $response = $client->http_request($url, 'GET', $params);
        if (isset($response['error_code'])) {
        }
        if (isset($response['comments'])) {
            return array('postId' => $topic['topic_source_id'], 'comments' => $response['comments']);
        }
        return null;
    }

    /*
     * $postComments: getCommentsFromChangYan() return
     * $time: last synced time(unix timestamp)
     * $return: count of comments(int)
     */
    private function insertComments($postComments, $time=1388505600)
    {
        global $zbp;
        if(!isset($postComments)) {
            return false;
        }
        $postID = $postComments['postId'];
        $commentsArray = $postComments['comments'];
        usort($commentsArray, array($this, 'cmtAscend')); //create_time递增排序
        $timeStone = $time - (5 * 60);
        $commentLastID = 0;
        for ($i = 0; $i < count($commentsArray); $i++) {
            $aComment = $commentsArray[$i];
            if((($aComment['create_time']) / 1000) <= $timeStone) {
                continue;
            }
            $cmt = $this->packageZblogComment($aComment,$postID);
            if(isset($aComment['comments'][0])){
                $parentComment = $this->findCommentInDB(array('create_time'=>$aComment['comments'][0]['create_time'],'content'=>$aComment['comments'][0]['content']), $postID);
                if(isset($parentComment)) {
                    $cmt->ParentID = $parentComment->ID;
                } else {
                    $cmt->ParentID = 0;
                }
            }
            $cmt->RootID = Comment::GetRootID($cmt->ParentID);
            // check comment already exists
            if($this->findCommentInDB(array('create_time'=>$aComment['create_time'],'content'=>$aComment['content']),$postID) == null) {
                $cmt->Save();
                $commentLastID = $cmt->ID;
            }
        }
        return $commentLastID;
    }

    /*
     * input: array
     * output: obj
     * */
    function packageZblogComment($aComment,$postID) {
        $cmt = New Comment;
        $cmt->LogID = $postID;
        $cmt->IsChecking = (bool)$aComment['status'];
        $cmt->AuthorID = 0;
        $cmt->Name = $aComment['passport']['nickname'];
        $cmt->Email = '';
        $cmt->HomePage = $aComment['passport']['profile_url'];
        $cmt->IP = $aComment['ip'];
        $cmt->PostTime = $aComment['create_time']/1000;
        $cmt->Content = $aComment['content'];
        $cmt->Agent = "Changyan_" . $aComment['comment_id'];
        return $cmt;

    }
    function findCommentInDB($aComment,$postID){
        global $zbp;
        $date=$aComment['create_time']/1000;
        $content=$aComment['content'];
        $w[] = array('=', 'comm_LogID', $postID);
        $w[] = array('=', 'comm_PostTime', $date);
        $w[] = array('=', 'comm_Content', $content);
        $comments = $zbp->GetCommentList('*', $w, null, null, null);
        if(count($comments) == 0) {
            return null;
        }else{
            return $comments[0];
        }
    }

    /* This is a comparation function used by usort in function insertComments() */
    private function cmtAscend($x, $y)
    {
        //return (intval($x['create_time'])) > (intval($y['create_time'])) ? 1 : -1;
        return ($x['create_time'] > $y['create_time'])? 1 : -1;
    }

    /* This is a comparation function used by usort in function insertComments() */
    private function cmtDescend($x, $y)
    {
        //return (intval($x['create_time'])) > (intval($y['create_time'])) ? -1 : 1;
        return ($x['create_time'] > $y['create_time'])? -1 : 1;
    }

    private function getOption($option)
    {
        global $zbp;
        return $zbp->Config('changyan')->$option;
    }

    private function setOption($option, $value)
    {
        global $zbp;
        $zbp->Config('changyan')->$option=$value;
        $zbp->SaveConfig('changyan');
    }

    public function getSyncProgress()
    {
        return $this->getOption('changyan_sync_progress');
    }

    private function setSyncProgress($progress)
    {
        $this->setOption('changyan_sync_progress', $progress);
    }
}

?>
