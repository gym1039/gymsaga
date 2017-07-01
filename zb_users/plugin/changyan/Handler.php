<?php

class Changyan_Handler
{
    private $PluginURL;
    private static $instance = null;
    public $changyanSynchronizer = null;

    private function __construct()
    {
        $this->PluginURL = plugin_dir_url(__FILE__);
        $this->changyanSynchronizer = Changyan_Synchronizer::getInstance();
    }

    private function __clone()
    {
        //Prevent from being cloned
    }

    //return the single instance of this class
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getOption($option)
    {
		global $zbp;
		return $zbp->Config('changyan')->$option;
    }

    public function setOption($option, $value)
    {
		global $zbp;
		$zbp->Config('changyan')->$option=$value;
		$zbp->SaveConfig('changyan');
		return true;
    }

    public function delOption($option)
    {
		global $zbp;
		$zbp->Config('changyan')->Del($option);
		$zbp->SaveConfig('changyan');
		return true;
    }

    public function sync2Zblog()
    {
        header('Content-Type: application/json');
        $response = $this->changyanSynchronizer->sync2Zblog();
        echo $response;
        die();
    }

    public function sync2Changyan()
    {
        header('Content-Type: application/json');
        $response = $this->changyanSynchronizer->sync2Changyan();
        echo $response;
        die();
    }

    public function cronSync()
    {
        $count = 0;
        $finish = false;
        do{
            $response = json_decode($this->changyanSynchronizer->sync2Zblog());
            $count += 1;
            if(isset($response->status) && $response->status == 0 || $count > 100) {
                $finish = true;
            }
        } while(!$finish);
    }

    public function setCode($appId, $conf, $isQuick=false)
    {
        $script = '';
        if($isQuick == false) {
            $script =<<< EOT
<div id="SOHUCS" sid=""></div>
<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
<script type="text/javascript">
    window.changyan.api.config({
    appid: '$appId',
    conf: '$conf'
    });
</script>
EOT;
        } else {
            // 兼容版代码, Wap支持AD
            $script =<<< EOT
<div id="SOHUCS"></div> 
<script type="text/javascript"> 
(function(){ 
    var appid = '$appId'; 
    var conf = '$conf'; 
    var width = window.innerWidth || document.documentElement.clientWidth; 
    if (width < 960) { 
        window.document.write('<script id="changyan_mobile_js" charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=' + appid + '&conf=' + conf + '"><\/script>'); 
    } else { 
        var loadJs=function(d,a){var c=document.getElementsByTagName("head")[0]||document.head||document.documentElement;var b=document.createElement("script");b.setAttribute("type","text/javascript");b.setAttribute("charset","UTF-8");b.setAttribute("src",d);if(typeof a==="function"){if(window.attachEvent){b.onreadystatechange=function(){var e=b.readyState;if(e==="loaded"||e==="complete"){b.onreadystatechange=null;a()}}}else{b.onload=a}}c.appendChild(b)};loadJs("http://changyan.sohu.com/upload/changyan.js",function(){window.changyan.api.config({appid:appid,conf:conf})}); 
    }})(); 
</script>
EOT;
        }
        $this->setOption('changyan_script', $script);
        return true;
    }

    // 畅言其他Js
    function getFooterJs()
    {
        $appid = $this->getOption('changyan_appId');
        $foot_js = <<< EOT
<script type="text/javascript" charset="utf-8" src="http://changyan.itc.cn/js/??lib/jquery.js,changyan.labs.js?appid=$appid"></script>
EOT;
        return $foot_js;
    }

    function getLogin()
    {
        $username = $this->getOption('changyan_username');
        $password = $this->getOption('changyan_password');
        $appid = $this->getOption('changyan_appId');
        $param = array('username' => $username, 'password' => $password, 'appid' => $appid, 'jsonp' => true);
        return http_build_query($param);
    }
    public function appinfo()
    {
        $appInfo = $_POST['appInfo'];
        list($appid,$appkey) = explode('|',$appInfo);
        $appid = trim($appid);
        $appkey = trim($appkey);
        $this->setOption('changyan_appId', $appid);
        $this->setOption('changyan_appKey', $appkey);
        $isQuick = $this->getOption('changyan_isQuick');

        $params = array(
            'app_id' => $appid
        );
        $client = new ChangYan_Client();
        $url = 'http://changyan.kuaizhan.com/getConf';
        $conf = $client->http_request($url, 'GET', $params);
        if ($conf != '站点不存在') {
            if( $isQuick == true){
                $this->setCode($appid, $conf, true);
            }
            else {
                $this->setCode($appid, $conf);
            }
        }
        //$redirect = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . "/admin.php?page=changyan";
        header("Location: main.php");
        die();
    }

    public function addIsv()
    {
        $username = $this->getOption('changyan_username');
        $password = $this->getOption('changyan_password');
        $url = $_SERVER['SERVER_NAME'];
        $name = ''; //get_bloginfo('name');
        $params = array(
            'username' => $username,
            'password' => $password,
            'isv_name' => empty($name)?'Wordpress Site':$name,
            'url' => $url
        );
        $client = new ChangYan_Client();
        $url = 'http://changyan.kuaizhan.com/extension/add-isv';
        $rs = $client->http_request($url, 'POST', $params);
        header( "Content-Type: application/json" );
        if ( $rs['code'] == 0) {
            $appid = trim($rs['data']['appid']);
            $appkey = trim($rs['data']['isv_app_key']);
            $this->setOption('changyan_appId', $appid);
            $this->setOption('changyan_appKey', $appkey);
            $response = json_encode(array('success'=>'true','appid'=>$appid));
        } else {
            $response = json_encode(array('success'=>'false', 'msg'=>$rs['msg']));
        }
        die($response);
    }

    public function register()
    {
        header( "Content-Type: application/json" );
        $response = json_encode(array('success'=>'true'));
        die($response);
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $username = trim($username);
        $password = trim($password);

        $params = array(
            'username' => $username,
            'password' => $password
        );
        $client = new ChangYan_Client();
        $url = 'http://changyan.kuaizhan.com/extension/login';
        $rs = $client->http_request($url, 'GET', $params);
        header( "Content-Type: application/json" );
        if ( $rs['code'] == 0) {
            // save username & password:
            $this->setOption('changyan_username', $username);
            $this->setOption('changyan_password', $password);
            $response = json_encode(array('success'=>'true','isvs'=>$rs['data']['isvs']));
        } else {
            $response = json_encode(array('success'=>'false', 'msg'=>$rs['msg']));
        }
        die($response);
    }

    public function logout()
    {
        $this->setOption('changyan_appId', '');
        $this->setOption('changyan_appKey', '');
        $this->setOption('changyan_username', '');
        $this->setOption('changyan_password', '');
        $this->setOption('changyan_script', '');
        header( "Content-Type: application/json" );
        $response = json_encode(array('success'=>'true'));
        die($response);
    }

    // 开启兼容模式
    public function setQuick()
    {
        $isChecked = $_POST['isQuick'];
        $isChecked = trim($isChecked);
        if ('checked' == $isChecked) {
            $this->setOption('changyan_isQuick', true);
        } else {
            $this->setOption('changyan_isQuick', false);
        }
        $appid = $this->getOption('changyan_appId');
        $params = array(
            'app_id' => $appid
        );
        $client = new ChangYan_Client();
        $url = 'http://changyan.kuaizhan.com/getConf';
        $conf = $client->http_request($url, 'GET', $params);
        if ($conf == '站点不存在') {
            $response = json_encode(array('success'=>'false', 'msg'=>$conf));
        } else {
            $this->setCode($appid, $conf, $isChecked=='checked'?true:false);
            $response = json_encode(array('success'=>'true'));
        }
        header( "Content-Type: application/json" );
        die($response);
    }

    // 开启定时任务
    public function setCron()
    {
        $isChecked = $_POST['isChecked'];
        $isChecked = trim($isChecked);
        $flag = 0;

        if ('checked' == $isChecked) {
            $flag = $this->setOption('changyan_isCron', true);
        } else {
            $flag = $this->setOption('changyan_isCron', false);
        }
        header( "Content-Type: application/json" );
        $response = "";
        if (!empty($flag) || $flag != false) {
            $response = json_encode(array('success'=>'true'));
        } else {
            $response = json_encode(array('success'=>'false'));
        }
        die($response);
    }

    // 开启SEO
    public function setSeo()
    {
        $isChecked = $_POST['isSEOChecked'];
        $isChecked = trim($isChecked);
        $flag = 0;
        if ('checked' == $isChecked) {
            $flag = $this->setOption('changyan_isSEO', true);
        } else {
            $flag = $this->setOption('changyan_isSEO', false);
        }
        header( "Content-Type: application/json" );
        $response = "";
        if (!empty($flag) || $flag != false) {
            $response = json_encode(array('success'=>'true'));
        } else {
            $response = json_encode(array('success'=>'false'));
        }
        die($response);
    }

    // 表情
    public function setEmoji()
    {
        $isChecked = $_POST['isChecked'];
        $isChecked = trim($isChecked);
        $flag = 0;
        $appid = $this->getOption('changyan_Emoji');
        $emoji_js = <<< EOT
<div id="cyEmoji" role="cylabs" data-use="emoji"></div>
EOT;
        if ('checked' == $isChecked) {
            $flag = $this->setOption('changyan_Emoji', true);
            $this->setOption('changyan_Emoji_Js', $emoji_js);
        } else {
            $flag = $this->setOption('changyan_Emoji', false);
            $this->setOption('changyan_Emoji_Js', '');
        }
        header( "Content-Type: application/json" );
        $response = "";
        if (!empty($flag) || $flag != false) {
            $response = json_encode(array('success'=>'true'));
        } else {
            $response = json_encode(array('success'=>'false'));
        }
        die($response);
    }
    public function getIsvIdByAppId()
    {
        $appId = $this->getOption('changyan_appId');
        $params = array(
            'app_id' => $appId
        );
        $client = new ChangYan_Client();
        $url = 'http://changyan.sohu.com/getIsvId';
        $isvId = $client->http_request($url, 'GET', $params);
        header("Content-Type: application/json");
        if ($isvId == 'isv not exists!') {
            $response = json_encode(array('success'=>'false', 'message'=>'站点不存在'));
            die($response);
        }
        $this->setOption('changyan_isvId', trim($isvId));
    }
}
?>
