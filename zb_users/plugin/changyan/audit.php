<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
if (!$zbp->CheckRights('root')) {$zbp->ShowError(6);exit();}
if (!$zbp->CheckPlugin('changyan')) {$zbp->ShowError(48);exit();}
$blogtitle='畅言评论系统';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
include_once dirname(__FILE__) . '/header.html';
$script = $changyanPlugin->getOption('changyan_script');
if(!empty($script)) {
?>
<!--user has login -->
<div id="divMain">
    <div class="divHeader"><?php echo $blogtitle;?></div>
    <div class="SubMenu"><?php changyan_SubMenus();?></div>
    <div id="cy-login">
        <iframe src="<?php echo "http://s.changyan.kuaizhan.com/extension/login?". $changyanPlugin->getLogin() ;?>"
                width="0" height="0">
        </iframe>
    </div>
    <div id="cy-audit">
        <iframe id="rightBar_1"
                src="http://s.changyan.kuaizhan.com/audit/comments/TOAUDIT/1"
                width="100%" height="100%" style="border:none">
        </iframe>
    </div>
</div>
<script>
    jQuery(function () {
        var $ = jQuery;
        var iframe = $('#rightBar_1');
        var resetIframeHeight = function () {
            iframe.height($(window).height() - iframe.offset().top - 70);
        };
        resetIframeHeight();
        $(window).resize(resetIframeHeight);
    });
</script>

<!--end -->
<?php
} else {
    Redirect('login.php');
}
require $blogpath . 'zb_system/admin/admin_footer.php';
include_once dirname(__FILE__) . '/scripts.html';
RunTime();
?>