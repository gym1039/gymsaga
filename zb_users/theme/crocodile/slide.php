<?php
$crocodile_Table='%pre%crocodile';
$crocodile_DataInfo=array(
    'ID'=>array('sean_ID','integer','',0),
    'Type'=>array('sean_Type','integer','',0),
    'Title'=>array('sean_Title','string',255,''),
    'Url'=>array('sean_Url','string',255,''),
    'Img'=>array('sean_Img','string',255,''),
    'Order'=>array('sean_Order','integer','',99),
    'Code'=>array('sean_Code','string',255,''),
    'IsUsed'=>array('sean_IsUsed','boolean','',true),
    'Intro'=>array('sean_Intro','string',255,''),
    'Addtime'=>array('sean_Addtime','integer','',0),
    'Endtime'=>array('sean_Endtime','integer','',0),
);

function crocodile_Get_Flash($crocodile_Table,$crocodile_DataInfo){
    global $zbp;
    $where = array(array('=','sean_Type','0'),array('=','sean_IsUsed','1'));
    $order = array('sean_IsUsed'=>'DESC','sean_Order'=>'ASC');
    $sql= $zbp->db->sql->Select($crocodile_Table,'*',$where,$order,null,null);
    $array=$zbp->GetListCustom($crocodile_Table,$crocodile_DataInfo,$sql);
	$i =1;
    $str = '
		<div id="home-slider" class="widget-box">
			<div class="widget-content">
				<ul class="bxslider">
            
    ';
	
    foreach ($array as $key => $reg) {
		$str .= "<li";
		//首次加载防止同时加载多个li标签，造成幻灯片依次全部显示，此处只显示第一个li标签，其他隐藏
		if($i!=1) $str .= ' style="display: none;">';
		else $str .= '>';
		$str .= '<a href="'.$reg->Url.'" title="'.$reg->Title.'" target="_blank"><img alt="'.$reg->Title.'" src="'.$reg->Img.'" /></a></li>';
		$i++;
    }
	
	$str .= '
			</ul>
		</div>
    ';
  @file_put_contents($zbp->usersdir . 'theme/'.$zbp->theme.'/include/slide.php', $str);
}

?>