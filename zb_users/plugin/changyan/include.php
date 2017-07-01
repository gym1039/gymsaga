<?php
define('CHANGYAN_PLUGIN_PATH', dirname(__FILE__));
require CHANGYAN_PLUGIN_PATH . '/Client.php';
require CHANGYAN_PLUGIN_PATH . '/Synchronizer.php';
require CHANGYAN_PLUGIN_PATH . '/Handler.php';

$changyanPlugin = Changyan_Handler::getInstance();

#注册插件
RegisterPlugin("changyan","ActivePlugin_changyan");

# enable plugin
function InstallPlugin_changyan() {
    // reset changyan option
}

# disable plugin
function UninstallPlugin_changyan() {
    global $zbp;
    $zbp->DelConfig('changyan');
}

#注册插件函数
function ActivePlugin_changyan() {
    global $zbp,$changyanPlugin;
	Add_Filter_Plugin('Filter_Plugin_Zbp_Load','changyan_init');
	Add_Filter_Plugin('Filter_Plugin_Admin_LeftMenu','changyan_AddMenu');
    // 载入模板前预处理
    Add_Filter_Plugin('Filter_Plugin_ViewPost_Begin','changyan_view_post_begin');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','changyan_view_post_template');
	Add_Filter_Plugin('Filter_Plugin_ViewList_Template','changyan_view_list_template');
    //载入模板
    Add_Filter_Plugin('Filter_Plugin_Template_GetTemplate','changyan_template_gettemplate');
	//Add_Filter_Plugin('Filter_Plugin_Html_Js_Add','changyan_html_js_add');
}

function changyan_init()
{
    global $zbp,$changyanPlugin;
    // 获取评论框同页评论数
    $zbp->header .= '<script type="text/javascript" src="http://assets.changyan.sohu.com/upload/plugins/plugins.count.js"></script>' . "\r\n";
    // 获取评论页外评论数
    $zbp->footer .= '<script id="cy_cmt_num" src="http://changyan.sohu.com/upload/plugins/plugins.list.count.js?clientId='. $changyanPlugin->getOption('changyan_appId') .'"></script>' . "\r\n";
}

function changyan_view_post_begin($id,$alias){
    global $zbp,$changyanPlugin;
    if(!$changyanPlugin->getOption('changyan_isCron')) 
        return;
    // cron job
    date_default_timezone_set('Etc/GMT-8');
    if(time() - $changyanPlugin->getOption('changyan_lastTimeSync2WP') > 3600){
        $changyanPlugin->cronSync();
    }
    $zbp->AddBuildModule('comments');
    $zbp->BuildModule();
}

function changyan_view_post_template(&$template){
    global $zbp,$changyanPlugin;
    // comments count
    $post = &$template->GetTags('article');
    $post->IsLock = false;
    $post->CommNums = '<a href="#SOHUCS" id="changyan_count_unit"></a>';
    $zbp->option['ZC_COMMENT_TURNOFF'] = true;
    // set tag for template
    $script = $changyanPlugin->getOption('changyan_script'); // 评论框js
    $emoji = $changyanPlugin->getOption('changyan_Emoji_Js'); // 表情js
    if (!empty($script)) {
        $article = $template->GetTags('article');
        $script = str_replace('sid=""', 'sid="'.$article->ID.'"', $script);
        //$template->SetTags('socialcomment', $script);
        $template->SetTags('changyan_comments_script', $emoji."\n".$script);
        // TODO: seo outputs
        if($changyanPlugin->getOption('changyan_isSEO') == true) {
        }

        // 畅言其他Js
        $template->SetTags('footer', $template->GetTags('footer') . $changyanPlugin->getFooterJs());
    }
}

function changyan_view_list_template(&$template){
    global $zbp,$changyanPlugin;
	$posts = &$template->GetTags('articles');
	foreach($posts as $post)
	{
		$post->CommNums = '<span id = "sourceId::'. $post->ID .'" class = "cy_cmt_count" ></span>';
	}
}

function changyan_template_gettemplate(&$template, $name)
{
    global $zbp,$changyanPlugin;
    if($name == 'commentpost'){
        // comment submit
    } else if($name == 'comments'){
        // conmment list
        $GLOBALS['Filter_Plugin_Template_GetTemplate']['changyan_template_gettemplate'] = PLUGIN_EXITSIGNAL_RETURN;
        return CHANGYAN_PLUGIN_PATH . '/comments.php';
    }
    $GLOBALS['Filter_Plugin_Template_GetTemplate']['changyan_template_gettemplate'] = PLUGIN_EXITSIGNAL_NONE;
    return '';
}

function changyan_html_js_add(){
    // do cron sync
    
}

function changyan_AddMenu(&$m){
	global $zbp;
	$b=false;
	$i=0;
	$s=MakeLeftMenu("root", "畅言评论", $zbp->host."zb_users/plugin/changyan/main.php", "nav_changyan", "aChangYan", $zbp->host."zb_users/plugin/changyan/cy.png");
	foreach($m as $key=>$value){
		if($key==='nav_comment'){
			$m[$key]=$s;
			$b=true;
		}
	}
	if(!$b){
		reset($m);
		foreach($m as $key=>$value){
			if(strpos($value,'act=CommentMng') !== false){
				$b=true;
				break;
			}
			$i=$i+1;
		}
		if($b){
			array_splice($m,$i,1,array('nav_changyan'=>$s));
		} else{
            $m["nav_changyan"]=$s;
        }
	}
}

function changyan_SubMenus()
{
    global $zbp;
    echo '<a href="main.php"><span class="m-left">插件选项</span></a>';
    echo '<a href="audit.php"><span class="m-left">畅言后台</span></a>';
}
?>
