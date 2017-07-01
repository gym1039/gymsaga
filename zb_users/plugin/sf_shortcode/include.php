<?php
#注册插件
RegisterPlugin("sf_shortcode","ActivePlugin_sf_shortcode");

function ActivePlugin_sf_shortcode() {
	Add_Filter_Plugin('Filter_Plugin_Edit_Begin','sf_shortcode_Filter_Plugin_Edit_Begin');
	Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','sf_shortcode_Style');
}
function InstallPlugin_sf_shortcode() {}
function UninstallPlugin_sf_shortcode() {}

function sf_shortcode_Filter_Plugin_Edit_Begin(){
	global $zbp;
	echo '<script src="'. $zbp->host .'zb_users/plugin/sf_shortcode/common.js" type="text/javascript"></script>';
	//echo '<link rel="stylesheet" rev="stylesheet" href="'. $zbp->host .'zb_users/plugin/sf_shortcode/common.css" type="text/css" media="all"/>';
}

function sf_shortcode_Style(){
	global $zbp;
	$zbp->header .='<link rel="stylesheet" rev="stylesheet" href="'. $zbp->host .'zb_users/plugin/sf_shortcode/common.css" type="text/css" media="all"/>';
}