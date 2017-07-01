<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
global $zbp,$changyanPlugin;
$zbp->Load();
if (!$zbp->CheckRights('root')) {$zbp->ShowError(6);exit();}
if (!$zbp->CheckPlugin('changyan')) {$zbp->ShowError(48);exit();}
$blogtitle='畅言评论系统';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
include_once dirname(__FILE__) . '/header.html';
$script = $changyanPlugin->getOption('changyan_script');
$username = $changyanPlugin->getOption('changyan_username');
$appID = $changyanPlugin->getOption('changyan_appId');
if(!empty($script) && !empty($username) && !empty($appID)) {
?>
<!--user has login -->
<div id="divMain">
    <div class="divHeader"><?php echo $blogtitle;?></div>
    <div class="SubMenu"><?php changyan_SubMenus();?></div>
    <div class="cyan-main" style="width: 800px">
        <table>
            <tr>
                <td>
                    <p class="start">&nbsp;</p>
                </td>
                <td>
                    <h3>账号设置</h3>
                </td>
            </tr>
            <tr>
                <td />
                <td>
                    <table>
                        <tr>
                            <td> 登录用户:</td>
                            <td>
                                <input type="text" id="username" class="inputbox inputbox-disable" disabled="disabled" value="<?php echo $username; ?>" style="text-align:left;" />
                            </td>
                            <td>
                                <input type="button" id="appButton" class="button button-rounded button-primary" value="退出" onclick="changyanLogout();return false;" style="width: 100px; text-align: center; vertical-align: middle" />
                            </td>
                        </tr>
                        <tr>
                            <td> App ID:</td>
                            <td>
                                <input type="text" id="appid" class="inputbox inputbox-disable" disabled="disabled" value="<?php echo $appID; ?>" style="text-align:left;" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width:10px;">
                    <p class="start">&nbsp;</p>
                </td>
                <td>
                    <h3>数据同步</h3>
                </td>
            </tr>
            <tr>
                <td />
                <td><span> 将本地数据库中的评论同步到畅言，即刻享受畅言带来的便利。 </span>
                </td>
            </tr>
            <tr>
                <td />
                <td style="padding-bottom:10px;">
                    <table>
                        <tr>
                            <td style="padding:10px 0;">
                                <div id="cyan-WP2cyan">
                                    <p class="message-start">
                                        <input type="button" id="appButton"
                                               class="button button-rounded button-primary" value="同步本地评论到畅言"
                                               onclick="sync2Cyan();"
                                               style="width: 180px; text-align: center; vertical-align: middle" />
                                    </p>
                                    <p class="status"></p>
                                    <p class="message-complete">同步完成</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;">
                                <div id="cyan-export">
                                    <p class="message-start">
                                        <input type="button" id="appButton"
                                               class="button button-rounded button-primary" value="同步畅言评论到本地"
                                               onClick="sync2WPress();return false;"
                                               style="width: 180px; text-align: center; vertical-align: middle" />
                                    </p>
                                    <p class="status"></p>
                                    <p class="message-complete">同步完成</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;">
                                <label>
                                    <input type="checkbox" id="changyanCron" name="changyanCronCheckbox" value="0"
                                        <?php if ($changyanPlugin->getOption('changyan_isCron')) echo 'checked'; ?> /> 定时从畅言同步评论到本地
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;">
                                <label>
                                    <input type="checkbox" id="changyanStyle" name="changyanStyle" value="1"
                                        <?php if ($changyanPlugin->getOption('changyan_isQuick')) echo 'checked'; ?> /> 开启兼容版本(PC/Wap自适应)
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;">
                                <label>
                                    <input type="checkbox" id="changyanSeo" name="changyanSeo" value="1"
                                        <?php if ($changyanPlugin->getOption('changyan_isSEO')) echo 'checked'; ?> /> 开启SEO优化
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0;">
                                <label>
                                    <input type="checkbox" id="changyanEmoji" name="changyanEmoji" value="1"
                                        <?php if ($changyanPlugin->getOption('changyan_Emoji')) echo 'checked'; ?> /> 开启评论表情
                                </label>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <script type="text/javascript">ActiveLeftMenu("aChangYan");</script>
        <script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/changyan/logo.png';?>");</script>
    </div>
</div>
<!--end -->
<?php
} else {
    Redirect('login.php');
}
require $blogpath . 'zb_system/admin/admin_footer.php';
include_once dirname(__FILE__) . '/scripts.html';
RunTime();
?>
