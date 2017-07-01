<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('crocodile')) {$zbp->ShowError(48);die();}

if($_GET['type'] == 'logo' ){

	global $zbp;

	foreach ($_FILES as $key => $value) {

		if(!strpos($key, "_php")){

			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {

				$tmp_name = $_FILES[$key]['tmp_name'];

				$name = $_FILES[$key]['name'];

				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/crocodile/style/images/logo.png');



			}

		}

	}

	$zbp->SetHint('good','修改成功');

	Redirect('main.php?act=config');

}

if($_GET['type'] == 'waplogo' ){

	global $zbp;

	foreach ($_FILES as $key => $value) {

		if(!strpos($key, "_php")){

			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {

				$tmp_name = $_FILES[$key]['tmp_name'];

				$name = $_FILES[$key]['name'];

				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/crocodile/style/images/waplogo.png');



			}

		}

	}

	$zbp->SetHint('good','修改成功');

	Redirect('main.php?act=wap');

}

if($_GET['type'] == 'flash' ){
	global $zbp;
	
	if(!$_POST["title"] or !$_POST["img"] or !$_POST["url"]){
		$zbp->SetHint('bad','标题或图片或链接不能为空');
		Redirect('./main.php');
		exit();
	}
	
	$DataArr = array(
		'sean_Title'=>$_POST["title"],
		'sean_Img'=>$_POST["img"],
		'sean_Url'=>$_POST["url"],
		'sean_Order'=>$_POST["order"],
		'sean_IsUsed'=>$_POST["IsUsed"]
	);

	if($_POST["editid"]){
		$where = array(array('=','sean_ID',$_POST["editid"]));
		$sql= $zbp->db->sql->Update($crocodile_Table,$DataArr,$where);
		$zbp->db->Update($sql);
	}else{
		$zbp->SetHint('good',$crocodile_Table);
		$sql= $zbp->db->sql->Insert($crocodile_Table,$DataArr);
		$zbp->db->Insert($sql);
	}
	crocodile_Get_Flash($crocodile_Table,$crocodile_DataInfo);
	$zbp->SetHint('good','幻灯保存成功');
	Redirect('./main.php?act=Slide');
}

if($_GET['type'] == 'flashdel' ){
	global $zbp;
	$where = array(array('=','sean_ID',$_GET['id']));
	$sql= $zbp->db->sql->Delete($crocodile_Table,$where);
	$zbp->db->Delete($sql);
	crocodile_Get_Flash($crocodile_Table,$crocodile_DataInfo);
	$zbp->SetHint('good','删除成功');
	Redirect('./main.php?act=Slide');
}

?>