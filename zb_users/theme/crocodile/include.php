<?php
include 'template/function.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'slide.php';
RegisterPlugin("crocodile","ActivePlugin_crocodile");

function ActivePlugin_crocodile(){
	Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','crocodile_AddMenu');
	Add_Filter_Plugin('Filter_Plugin_Search_Begin','SearchPlus_Main');	
}

function crocodile_AddMenu(&$m){
	global $zbp;
	array_unshift($m, MakeTopMenu("root",'鳄鱼主题配置',$zbp->host . "zb_users/theme/crocodile/main.php?act=config","","topmenu_crocodile"));
}

function SearchPlus_Main() {
	global $zbp;
 
    foreach ($GLOBALS['Filter_Plugin_ViewSearch_Begin'] as $fpname => &$fpsignal) {
        $fpreturn = $fpname();
        if ($fpsignal == PLUGIN_EXITSIGNAL_RETURN) {
            $fpsignal=PLUGIN_EXITSIGNAL_NONE;return $fpreturn;
        }
    }
 
    if(!$zbp->CheckRights($GLOBALS['action'])){Redirect('./');}
 
    $q = trim(htmlspecialchars(GetVars('q','GET')));
    $qc = '<b style=\'color:red\'>' . $q . '</b>';
 
    $articles = array();
    $category = new Metas;
    $author = new Metas;
    $tag = new Metas;
 
//    $type = 'post-search';
 
    $zbp->title = $zbp->lang['msg']['search'] . ' &quot;' . $q . '&quot;';
 
    $template = $zbp->option['ZC_INDEX_DEFAULT_TEMPLATE'];
 
    if(isset($zbp->templates['search'])){
        $template = 'search';
    }
 
    $w=array();
    $w[]=array('=','log_Type','0');
    if($q){
        $w[]=array('search','log_Content','log_Intro','log_Title',$q);
    }else{
        Redirect('./');
    }
 
    if(!($zbp->CheckRights('ArticleAll')&&$zbp->CheckRights('PageAll'))){
        $w[]=array('=','log_Status',0);
    }
 
	$pagebar=new Pagebar('{%host%}search.php?{q='.$q.'}&{page=%page%}',false);
	$pagebar->PageCount=$zbp->displaycount; 
	$pagebar->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
	$pagebar->PageBarCount=$zbp->pagebarcount;
 
    $articles = $zbp->GetArticleList(
        '*', 
        $w,
        array('log_PostTime' => 'DESC'), array(($pagebar->PageNow - 1) * $pagebar->PageCount, $pagebar->PageCount),
        array('pagebar' => $pagebar),
        null
    );
	
    foreach($articles as $article){
        $intro = preg_replace('/[\r\n\s]+/', '', trim(SubStrStartUTF8(TransferHTML($article->Content,'[nohtml]'),$q,170)) . '...');
        $article->Intro = str_ireplace($q,$qc,$intro);
        $article->Title = str_ireplace($q,$qc,$article->Title);
    }
 
    $zbp->header .= '<meta name="robots" content="noindex,follow" />' . "\r\n";
    $zbp->template->SetTags('title', $zbp->title);
    $zbp->template->SetTags('articles',$articles);
    $zbp->template->SetTags('page',1);
    $zbp->template->SetTags('pagebar',$pagebar);
 
    if (isset($zbp->templates['search'])) {
        $zbp->template->SetTemplate($template);
    } 
	else {
        $zbp->template->SetTemplate('index');
    }
 
    foreach ($GLOBALS['Filter_Plugin_ViewList_Template'] as $fpname => &$fpsignal) {
        $fpreturn=$fpname($zbp->template);
    }
 
    $zbp->template->Display();
    RunTime();
    die();
}

function crocodile_SubMenu($id){
	$arySubMenu = array(
		0 => array('基本设置', 'config', 'left', false),
		1 => array('外观设置', 'wzjbys', 'left', false),
		2 => array('CMS模块设置', 'cmsmk', 'left', false),
		3 => array('幻灯片设置', 'Slide', 'left', false),
		4 => array('广告设置', 'ad', 'left', false),
		5 => array('手机版设置', 'wap', 'left', false),
		6 => array('主题说明', 'explain', 'left', false),
	);
	foreach($arySubMenu as $k => $v){
		echo '<a href="?act='.$v[1].'" '.($v[3]==true?'target="_blank"':'').'><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
	}
}

function crocodile_TimeAgo( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '个月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '周前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}

function fyrmmot($count = 10, $cate = null, $auth = null, $date = null, $tags = null, $search = null, $option = null,$order=null) {
    global $zbp;
    if (!is_array($option)) {
        $option = array();
    }
    if (!isset($option['only_ontop']))
        $option['only_ontop'] = false;
    if (!isset($option['only_not_ontop']))
        $option['only_not_ontop'] = false;
    if (!isset($option['has_subcate']))
        $option['has_subcate'] = false;
    if (!isset($option['is_related']))
        $option['is_related'] = false;
    if ($option['is_related']) {
        $at = $zbp->GetPostByID($option['is_related']);
        $tags = $at->Tags;
        if (!$tags)
            return array();
        $count = $count + 1;
    }
    if ($option['only_ontop'] == true) {
        $w[] = array('=', 'log_IsTop', 0);
    } elseif ($option['only_not_ontop'] == true) {
        $w[] = array('=', 'log_IsTop', 1);
    }
    $w = array();
    $w[] = array('=', 'log_Status', 0);
    $articles = array();
    if (!is_null($cate)) {
        $category = new Category;
        $category = $zbp->GetCategoryByID($cate);
        if ($category->ID > 0) {
            if (!$option['has_subcate']) {
                $w[] = array('=', 'log_CateID', $category->ID);
            } else {
                $arysubcate = array();
                $arysubcate[] = array('log_CateID', $category->ID);
                foreach ($zbp->categorys[$category->ID]->SubCategorys as $subcate) {
                    $arysubcate[] = array('log_CateID', $subcate->ID);
                }
                $w[] = array('array', $arysubcate);
            }
        }
    }
    if (!is_null($auth)) {
        $author = new Member;
        $author = $zbp->GetMemberByID($auth);
 
        if ($author->ID > 0) {
            $w[] = array('=', 'log_AuthorID', $author->ID);
        }
    }
    if (!is_null($date)) {
        $datetime = strtotime($date);
        if ($datetime) {
            $datetitle = str_replace(array('%y%', '%m%'), array(date('Y', $datetime), date('n', $datetime)), $zbp->lang['msg']['year_month']);
            $w[] = array('BETWEEN', 'log_PostTime', $datetime, strtotime('+1 month', $datetime));
        }
    }
    if (!is_null($tags)) {
        $tag = new Tag;
        if (is_array($tags)) {
            $ta = array();
            foreach ($tags as $t) {
                $ta[] = array('log_Tag', '%{' . $t->ID . '}%');
            }
            $w[] = array('array_like', $ta);
            unset($ta);
        } else {
            if (is_int($tags)) {
                $tag = $zbp->GetTagByID($tags);
            } else {
                $tag = $zbp->GetTagByAliasOrName($tags);
            }
            if ($tag->ID > 0) {
                $w[] = array('LIKE', 'log_Tag', '%{' . $tag->ID . '}%');
            }
        }
    }
    if (is_string($search)) {
        $search=trim($search);
        if ($search!=='') {
            $w[] = array('search', 'log_Content', 'log_Intro', 'log_Title', $search);
        }
    }    
    if(!empty($order)){
    if($order=='new'){
        $order = array('log_PostTime'=>'DESC');
    }
    if($order=='hot'){
        $order = array('log_ViewNums'=>'DESC');
    }
    if($order=='comm'){
        $order = array('log_CommNums'=>'DESC');
    }
    if($order=='rand'){
        $order = array('rand()'=>' ');
    }
    }
    $articles = $zbp->GetArticleList('*', $w, $order, $count, null, false);
    if ($option['is_related']) {
        foreach ($articles as $k => $a) {
            if ($a->ID == $option['is_related'])
                unset($articles[$k]);
        }
        if (count($articles) == $count){
            array_pop($articles);
        }
    }
    return $articles;
}

function InstallPlugin_crocodile(){
	global $zbp;
	
	CustomMoudle();
	
	crocodile_CreateTable();
    if(!$zbp->Config('crocodile')->HasKey('Version')){
		$zbp->Config('crocodile')->Version = '1.0';
		$zbp->Config('crocodile')->Keywords = '填写站点关键词';
        $zbp->Config('crocodile')->Description = '填写站点描述';
		$zbp->Config('crocodile')->beian = '备案信息';
		$zbp->Config('crocodile')->Tongji = '统计代码';
		$zbp->Config('crocodile')->Welcome = '欢迎来郭延明个人博客，感谢你的支持！';
		$zbp->Config('crocodile')->YLink = 'http://list.qq.com/cgi-bin/qf_invite?id=0d844b73199652ee5e8d84738579c9b5d3b1c02aecaf4447';
		$zbp->Config('crocodile')->QGroup = 'http://shang.qq.com/wpa/qunwpa?idkey=944ca1519c392e585657d7fc8b49277f789ff945b5d9a0fb03c17670d9dc9f23';	
		$zbp->Config('crocodile')->ToolBar = '<li id="qq" class="other-nav"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=946476210&amp;site=qq&amp;menu=yes"> <img border="0" src="http://www.gymsaga.com/wp-content/themes/HotNewspro/images/qq.gif" width="77" height="22" alt="点击这里给站长发消息" title="点击这里给站长发消息"></a></li>';			
		$zbp->Config('crocodile')->Color1 = '#00b5ee';
		$zbp->Config('crocodile')->Color2 = '#00b5ee';
		$zbp->Config('crocodile')->byimg = '1';
		$zbp->Config('crocodile')->bcms = '1';
		$zbp->SaveConfig('crocodile');
	}
		
	$zbp->SaveConfig('crocodile');
		 
}

function crocodile_CreateTable(){
    global $zbp;
	if(!$zbp->db->ExistTable($GLOBALS['crocodile_Table'])){
		$s=$zbp->db->sql->CreateTable($GLOBALS['crocodile_Table'],$GLOBALS['crocodile_DataInfo']);
		$zbp->db->QueryMulit($s);
	}
}


?>