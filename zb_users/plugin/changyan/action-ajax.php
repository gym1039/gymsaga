<?php
require '../../../zb_system/function/c_system_base.php';
//$zbp->Load();
//if (!$zbp->CheckRights('root')) {$zbp->ShowError(6);exit();}
//if (!$zbp->CheckPlugin('changyan')) {$zbp->ShowError(48);exit();}
global $changyanPlugin;

switch($_REQUEST['action']) {
    case 'changyan_sync2Zblog':
        $changyanPlugin->sync2Zblog();
        break;
    case 'changyan_sync2Changyan':
        $changyanPlugin->sync2Changyan();
        break;
    case 'changyan_register':
        $changyanPlugin->register();
        break;
    case 'changyan_login':
        $changyanPlugin->login();
        break;
    case 'changyan_logout':
        $changyanPlugin->logout();
        break;
    case 'changyan_appinfo':
        $changyanPlugin->appinfo();
        break;
    case 'changyan_cron':
        $changyanPlugin->setCron();
        break;
    case 'changyan_cron_job':
        $changyanPlugin->cronSync();
        break;
    case 'changyan_add_isv':
        $changyanPlugin->addIsv();
        break;
    case 'changyan_quick_load':
        $changyanPlugin->setQuick();
        break;
    case 'changyan_seo':
        $changyanPlugin->setSeo();
        break;
    case 'changyan_emoji':
        $changyanPlugin->setEmoji();
        break;
}
