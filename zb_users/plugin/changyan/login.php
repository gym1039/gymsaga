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
?>
<div id="divMain">
    <div class="divHeader"><?php echo $blogtitle;?></div>
    <div class="cyan-main" style="width: 800px">
        <br /><br />
        <table>
            <tr>
                <td>
                    <p class="start">&nbsp;</p>
                </td>
                <td>
                    <h3>登录畅言</h3>
                </td>
            </tr>
            <tr>
                <td />
                <td>
                    <table id="login_info">
                        <tr>
                            <td> 账号: </td>
                            <td>
                                <input type="text" id="username" class="inputbox" value="" style="text-align:left;" />
                            </td>
                        </tr>
                        <td />
                        <tr>
                            <td> 密码: </td>
                            <td>
                                <input type="password" id="password" class="inputbox" value="" style="text-align:left;" />
                            </td>
                        </tr>
                        <td />
                        <tr>
                            <td colspan=2 style="text-align: left;">
                                <input type="button" id="appButton" class="button button-rounded button-primary" value="登录" onclick="changyanLogin();return false;" style="width: 100px; text-align: center; vertical-align: middle" />
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td colspan="2" id="isvs_info">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        </table>
        <br /><br />
        <table>
            <tr>
                <td>
                    <p class="start">&nbsp;</p>
                </td>
                <td>
                    <h3>没有畅言账号?</h3>
                </td>
            </tr>
            <tr>
                <td />
                <td>
                    <table>
                        <tr>
                            <td style="text-align: left;">
                                <input type="button" id="appButton" class="button button-rounded button-primary" value="注册" onclick="changyanRegister();return false;" style="width: 100px; text-align: center; vertical-align: middle" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
include_once dirname(__FILE__) . '/scripts.html';
RunTime();
?>