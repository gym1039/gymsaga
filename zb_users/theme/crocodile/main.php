<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('crocodile')) {$zbp->ShowError(48);die();}
$blogtitle='鳄鱼主题配置';

$act = "";
if ($_GET['act']){
$act = $_GET['act'] == "" ? 'config' : $_GET['act'];
}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

if(isset($_POST['Keywords'])){
	$zbp->Config('crocodile')->Keywords = $_POST['Keywords'];
	$zbp->Config('crocodile')->Description = $_POST['Description'];
	$zbp->Config('crocodile')->beian = $_POST['beian'];
	$zbp->Config('crocodile')->Tongji = $_POST['Tongji'];
	$zbp->SaveConfig('crocodile');
	$zbp->ShowHint('good');
}

if(isset($_POST['Welcome'])){
	$zbp->Config('crocodile')->Welcome = $_POST['Welcome'];
	$zbp->Config('crocodile')->YLink = $_POST['YLink'];
	$zbp->Config('crocodile')->QGroup = $_POST['QGroup'];
	$zbp->Config('crocodile')->ToolBar = $_POST['ToolBar'];
	$zbp->Config('crocodile')->Color1 = $_POST['Color1'];
	$zbp->Config('crocodile')->Color2 = $_POST['Color2'];
	$zbp->SaveConfig('crocodile');
	$zbp->ShowHint('good');
}

if(isset($_POST['ciqucmsmk'])){
    $zbp->Config('crocodile')->ciqucmsmk = $_POST['ciqucmsmk'];
	$zbp->Config('crocodile')->byimg = $_POST['byimg'];
	$zbp->Config('crocodile')->biquxmsmk = $_POST['biquxmsmk'];
	$zbp->Config('crocodile')->bcms = $_POST['bcms'];
	$zbp->Config('crocodile')->sylink = $_POST['sylink'];
	$zbp->SaveConfig('crocodile');
	$zbp->ShowHint('good');
}

if(isset($_POST['Ad1'])){
	$zbp->Config('crocodile')->Ad1 = $_POST['Ad1'];
	$zbp->Config('crocodile')->DisplayAd1 = $_POST['DisplayAd1'];
	$zbp->Config('crocodile')->Ad2 = $_POST['Ad2'];
	$zbp->Config('crocodile')->DisplayAd2 = $_POST['DisplayAd2'];
	$zbp->Config('crocodile')->Ad3 = $_POST['Ad3'];
	$zbp->Config('crocodile')->DisplayAd3 = $_POST['DisplayAd3'];
	$zbp->Config('crocodile')->Ad4 = $_POST['Ad4'];
	$zbp->Config('crocodile')->DisplayAd4 = $_POST['DisplayAd4'];	
	$zbp->Config('crocodile')->Ad5 = $_POST['Ad5'];
	$zbp->Config('crocodile')->DisplayAd5 = $_POST['DisplayAd5'];	
	$zbp->Config('crocodile')->Ad6 = $_POST['Ad6'];
	$zbp->Config('crocodile')->DisplayAd6 = $_POST['DisplayAd6'];	
	$zbp->SaveConfig('crocodile');
	$zbp->ShowHint('good');
}

if(isset($_POST['sytout'])){
    $zbp->Config('crocodile')->sytout = $_POST['sytout'];
	$zbp->Config('crocodile')->sytout2 = $_POST['sytout2'];
	$zbp->Config('crocodile')->sytout3 = $_POST['sytout3'];
	$zbp->Config('crocodile')->dianzanf = $_POST['dianzanf'];
	$zbp->Config('crocodile')->wapslide = $_POST['wapslide'];
    $zbp->SaveConfig('crocodile');
	$zbp->ShowHint('good');
}

?>
<style>
.zwsrk{  width: 100%;font-size: 15px;height: 150px;min-height: 40px;margin: 0;margin-top: 10px;padding: 8px 8px;color: #333;background-color: #fff;border: 1px solid #d7d7d7;box-sizing: border-box;vertical-align: middle;}
</style>
<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
	<?php crocodile_SubMenu($act);?>
     <a href="http://www.gymsaga.com/" target="_blank"><span class="m-right">技术支持</span></a>
    </div>
<div id="divMain2">
<?php if ($act == 'config') { ?>
<table id="form1" name="form1" width="100%" style="padding:0;margin:0;" cellspacing="0" cellpadding="0" class="tableBorder">
<tr>
    <th width="30%"><p align="center">图片名称</p></th>
    <th width="20%"><p align="center">当前图片</p></th>
	<th width="50%"><p align="center">上传文件</p></th>
  </tr>
  <form enctype="multipart/form-data" method="post" action="save.php?type=logo">
	<tr>
    <td><p align="center">LOGO（420X85）</p></td>
	<td>
	<p align="center"><a href="style/images/logo.png" target="_blank"><img src="style/images/logo.png" height="40px"></a></p>
	</td>
	<td><p align="center"><input name="logo.png" type="file"/><input name="" type="Submit" class="button" value="保存"/></p></td>
	</tr>
	</form> 
</table>
<form id="form2" name="form2" method="post">	
    <table width="100%" style="padding:0;margin:0;" cellspacing="0" cellpadding="0" class="tableBorder">
		<tr>
			<th width="15%"><p align="center">项目名称</p></th>
			<th width="50%"><p align="center">文本/代码</p></th>
			<th width="25%"><p align="center">说明</p></th>
		</tr>
		<tr>
			<td><label for="Keywords"><p align="center">站点关键词</p></label></td>
			<td><p align="left"><textarea name="Keywords" type="text" id="Keywords" style="width:98%;"><?php echo $zbp->Config('crocodile')->Keywords;?></textarea></p></td>
			<td><p align="left">填写站点关键词</p></td>
		</tr>
		<tr>
			 <td><label for="Description"><p align="center">站点描述</p></label></td>
			<td><p align="left"><textarea name="Description" type="text" id="Description" style="width:98%;"><?php echo $zbp->Config('crocodile')->Description;?></textarea></p></td>
			<td><p align="left">填写站点描述</p></td>
		</tr>
		<tr>
			<td><label for="beian"><p align="center">备案信息</p></label></td>
			<td><p align="left"><textarea name="beian" type="text" id="beian" style="width:98%;"><?php echo $zbp->Config('crocodile')->beian;?></textarea></p></td>
			<td><p align="left">添加备案信息</p></td>
		</tr>
		<tr>
			<td><label for="Tongji"><p align="center">统计代码</p></label></td>
			<td><p align="left"><textarea name="Tongji" type="text" id="Tongji" style="width:98%;"><?php echo $zbp->Config('crocodile')->Tongji;?></textarea></p></td>
			<td><p align="left">添加统计代码</p></td>
		</tr>
	</table>
	<br />
	<input name="" type="Submit" class="button" style="margin-top:10px;width:99%;padding:0 auto;" value="保存"/>
</form>
<?php } if ($act == 'wzjbys') { ?>
<form id="form2" name="form2" method="post">	
<table width="100%" style="padding:0;margin:0;" cellspacing="0" cellpadding="0" class="tableBorder">
		<tr>
			<th width="15%"><p align="center">项目名称</p></th>
			<th width="50%"><p align="center">文本/代码</p></th>
			<th width="25%"><p align="center">说明</p></th>
		</tr>
	    <tr>
			<td><label for="Welcome"><p align="center">顶部欢迎语</p></label></td>
			<td><p align="left"><textarea name="Welcome" type="text" id="Welcome" style="width:98%;"><?php echo $zbp->Config('crocodile')->Welcome;?></textarea></p></td>
			<td><p align="left">设置顶部欢迎语或者公告</p></td>
		</tr>	
		<tr>
			<td><label for="YLink"><p align="center">邮箱订阅地址</p></label></td>
			<td><p align="left"><textarea name="YLink" type="text" id="YLink" style="width:98%;"><?php echo $zbp->Config('crocodile')->YLink;?></textarea></p></td>
			<td><p align="left">用来添加网站收藏之类的</p></td>
		</tr>
		
		<tr>
			<td><label for="QGroup"><p align="center">加入Q群地址</p></label></td>
			<td><p align="left"><textarea name="QGroup" type="text" id="QGroup" style="width:98%;"><?php echo $zbp->Config('crocodile')->QGroup;?></textarea></p></td>
			<td><p align="left">让用户一键添加QQ群</p></td>
		</tr>
		
		<tr>
			<td><label for="ToolBar"><p align="center">自定义工具栏</p></label></td>
			<td><p align="left"><textarea name="ToolBar" type="text" id="ToolBar" style="width:98%;"><?php echo $zbp->Config('crocodile')->ToolBar;?></textarea></p></td>
			<td><p align="left">继续添加相应的功能按钮，标签格式为<?php echo htmlspecialchars('<li><a><img>文本内容</a></li>') ?> </p></td>
		</tr>
	</table>
	<table width="100%" style='padding:0;margin-top:5px;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <th width="10%"><p align="center">项目名称</p></th>
    <th width="21%"><p align="center">颜色代码</p></th>
	<th width="15%"><p align="center">备注说明</p></th>
	<th width="4%"><p align="center"></p></th>
    <th width="10%"><p align="center">项目名称</p></th>
    <th width="21%"><p align="center">颜色代码</p></th>
	<th width="15%"><p align="center">备注说明</p></th>
  </tr>
	<tr>
	<td><p align="center">模板颜色</p></td>
	<td><p align="center"><input id="Color1" name="Color1" value=<?php echo $zbp->Config('crocodile')->Color1  ?> /><span  style="width:30px;height:auto;padding:0 10px;margin-left:10px;background-color:<?php echo $zbp->Config('crocodile')->Color1  ?>;"></p></td>
	<td><p align="center">默认颜色 "#00b5ee" </p></td>
	<td></td>
   <td><p align="center">文章标题颜色</p></td>
	<td><p align="center"><input id="Color2" name="Color2" value=<?php echo $zbp->Config('crocodile')->Color2  ?> /><span  style="width:30px;height:auto;padding:0 10px;margin-left:10px;background-color:<?php echo $zbp->Config('crocodile')->Color2  ?>;"></p></td>
	<td><p align="center">默认颜色 "#00b5ee" </p></td>
	</tr>
	</table>	
	<br />
	<input name="" type="Submit" class="button" style="margin-top:10px;width:99%;padding:0 auto;" value="保存"/>
</form>
<?php } if ($act == 'cmsmk') { ?>
<form id="form3" name="form3" method="post">
 <table width="100%" style='padding:0;margin-top:5px;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <th width="25%"><p align="center">项目名称</p></th>
    <th width="30%"><p align="center">分类ID</p></th>
	<th width="30%"><p align="center">是否启用</p></th>
	<th width="15%"><p align="center">备注说明</p></th>
  </tr>
<tr>
    <td><p align="center">A区CMS模块</p></td>
	<td><p align="center"> <input name="ciqucmsmk" style="width:98%;" type="text" value="<?php echo $zbp->Config('crocodile')->ciqucmsmk; ?>" /></p></td>
	<th><p align="center"><input type="text" id="byimg" name="byimg" class="checkbox" value="<?php echo $zbp->Config('crocodile')->byimg;?>"/></p></th>
	<td><p align="center" style="color: rgb(255, 0, 0);">输入分类ID，只允许输入数字</p></td>
	</tr>
</table>
<table width="100%" style='padding:0;margin-top:5px;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <th width="25%"><p align="center">项目名称</p></th>
    <th width="30%"><p align="center">分类ID</p></th>
	<th width="30%"><p align="center">是否启用</p></th>
	<th width="15%"><p align="center">备注说明</p></th>
  </tr>
<tr>
    <td><p align="center">B区CMS模块</p></td>
	<td><p align="center"> <input name="biquxmsmk" style="width:98%;" type="text" value="<?php echo $zbp->Config('crocodile')->biquxmsmk; ?>" /></p></td>
	<th><p align="center"><input type="text" id="bcms" name="bcms" class="checkbox" value="<?php echo $zbp->Config('crocodile')->bcms;?>"/></p></th>
	<td><p align="center" style="color: rgb(255, 0, 0);">输入分类ID，只允许输入数字</p></td>
	</tr>
</table>
<table width="100%" style='padding:0;margin-top:5px;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <th width="100%"><p style="color: rgb(255, 0, 0);" align="center">每添加一个分类ID，前台页面自动增加一个CMS模块，需要注意的是填写多个分类请用英文,符号分隔！</p></th>
   </tr>
</table>
<table width="100%" style='padding:0;margin-top:5px;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
   <th width="50%"><p align="center">是否启用<br><input type="text" id="sylink" name="sylink" class="checkbox" value="<?php echo $zbp->Config('crocodile')->sylink;?>"/></p></th>
	<td width="50%"><p align="center" style="color: rgb(255, 0, 0);">是否启用首页友情链接模块</p></td>
	</tr>
</table>
<br />
	<input name="" type="Submit" class="button" style="margin-top:10px;width:99%;padding:0 auto;" value="保存"/>
</form>

<?php } if ($act == 'explain'){
	?>

<form id="form3" name="form3" method="post">	
    <table width="100%" style='padding:0;margin-top:5px;' cellspacing='0' cellpadding='0' class="tableBorder">
        <tr>
            <th width="100%"><p>【主题设置说明】</p></th>
        </tr>
        <tr>
	        <td>
			    <p>
                    <span style="color: rgb(255, 0, 0);">手机版幻灯片代码示例：</span>
                </p>
	            <p>
					&lt;li&gt;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class=&quot;pic&quot; href=&quot;指向链接&quot;&gt;&lt;img src=&quot;图片链接&quot;&gt;&lt;/a&gt;<br/>&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class=&quot;tit&quot; href=&quot;指向链接&quot;&gt;标题名称&lt;/a&gt;<br/>&lt;/li&gt;
				</p>
            </td>
	    </tr>
    </table>
	<table width="100%" style='padding:0;margin-top:5px;' cellspacing='0' cellpadding='0' class="tableBorder">
        <tr>
            <th width="100%"><p>【手机版使用说明】</p></th>
        </tr>
        <tr>
	        <td>
			    <p>
					1.在主题管理中上传已下载至本地的手机版安装包
				</p>
				<p>
					2.在应用中心搜索并安装【双主题-手机版调用】插件
				</p>
				<p>
					3.启用【双主题-手机版调用】插件，并在主题管理中调用手机版主题
				</p>
            </td>
	    </tr>
    </table>
    <table width="100%" style='padding:0;margin-top:5px;' cellspacing='0' cellpadding='0' class="tableBorder">
        <tr>
            <th width="100%"><p>【安装须知】</p></th>
        </tr>
        <tr>
	        <td>
		        <p>
                    <span style="color: rgb(255, 0, 0);">谢谢各位购买者的支持！</span>
                </p> 
                <p>
                    <span style="color: rgb(255, 0, 0);">【烽烟工作室】提供zblog企业模板、zblog淘宝客模板、zblog插件、zblog免费模板下载。
承接zblog模板定制、zblog仿站、zblog模板修改、zblog插件定制等业务。</span>
                </p> 
                <p>
                     <span style="color: rgb(255, 0, 0);">建站技术交流群：99464245</span>
                </p>
			</td>
	    </tr>
    </table>
</form>

<?php } if ($act == 'wap'){
	?>
<table id="form1" name="form1" width="100%" style="padding:0;margin:0;" cellspacing="0" cellpadding="0" class="tableBorder">
<tr>
<th width="100%"><p>
                    【当前手机版本为1.1】 点击链接下载手机版：<a href="http://pan.baidu.com/s/1gdpVDyN" target="_blank">http://pan.baidu.com/s/1gdpVDyN</a>&nbsp;&nbsp;&nbsp;密码：2zlg
               </p></th>
</tr>
</table>	
	<form id="form3" name="form3" method="post">
 <table width="100%" style='padding:0;margin-top:5px;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <th width="16.6%"><p align="center">项目名称</p></th>
    <th width="16.6%"><p align="center">文章ID</p></th>
	<th width="16.6%"><p align="center">项目名称</p></th>
	<th width="16.6%"><p align="center">文章ID</p></th>
	<th width="16.6%"><p align="center">项目名称</p></th>
	<th width="16.6%"><p align="center">文章ID</p></th>
  </tr>
<tr>
    <td><p align="center">首页头条1</p></td>
	<td><p align="center"> <input name="sytout" style="width:90%;" type="text" value="<?php echo $zbp->Config('crocodile')->sytout; ?>" /></p></td>
	<td><p align="center">首页头条2</p></td>
	<td><p align="center"> <input name="sytout2" style="width:90%;" type="text" value="<?php echo $zbp->Config('crocodile')->sytout2; ?>" /></p></td>
	<td><p align="center">首页头条3</p></td>
	<td><p align="center"> <input name="sytout3" style="width:90%;" type="text" value="<?php echo $zbp->Config('crocodile')->sytout3; ?>" /></p></td>
	</tr>
</table>
<table width="100%" style='padding:0;margin-top:5px;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
   <th width="50%"><p align="center">是否启用点赞功能<br><input type="text" id="dianzanf" name="dianzanf" class="checkbox" value="<?php echo $zbp->Config('crocodile')->dianzanf;?>"/></p></th>
	<td width="50%"><p align="center" style="color: rgb(255, 0, 0);">启用点赞功能需要提前安装插件【文章点赞开发版】</p></td>
	</tr>
</table>
<table width="100%" cellspacing='0' cellpadding='0'>
   <tr>
    <th width="100%"><p align="center">手机版幻灯片设置</p></th>
   </tr>
    <tr>
  <td><p align="left"><textarea class="zwsrk" name="wapslide" type="text" id="wapslide"><?php echo $zbp->Config('crocodile')->wapslide;?></textarea></p></td>
    </tr>
 </table>
<input name="" type="Submit" class="button" style="margin-top:10px;width:99%;padding:0 auto;" value="保存"/>
</form>
	


<?php } if ($act == 'ad'){
	?>
	<form id="form3" name="form3" method="post">	
	<table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
	<tr>
		<th width="15%"><p align="center">AD编号</p></th>
		<th width="40%"><p align="center">广告代码</p></th>
		<th width="10%"><p align="center">是否开启</p></th>
		<th width="25%"><p align="center">备注</p></th>
	</tr>
	<tr>
		<td><label for="Ad1"><p align="center">广告位1</p></label></td>
		<td><p align="left"><textarea name="Ad1" type="text" id="Ad1" style="width:98%;"><?php echo $zbp->Config('crocodile')->Ad1;?></textarea></p></td>
		<td><p align="center"><input type="text" id="DisplayAd1" name="DisplayAd1" class="checkbox" value="<?php echo $zbp->Config('crocodile')->DisplayAd1;?>" /></p></td>
		<td><p align="left">位置：首页幻灯片右边，465×345</p></td>
	</tr>
	<tr>
		<td><label for="Ad2"><p align="center">广告位2</p></label></td>
		<td><p align="left"><textarea name="Ad2" type="text" id="Ad2" style="width:98%;"><?php echo $zbp->Config('crocodile')->Ad2;?></textarea></p></td>
		<td><p align="center"><input type="text" id="DisplayAd2" name="DisplayAd2" class="checkbox" value="<?php echo $zbp->Config('crocodile')->DisplayAd2;?>" /></p></td>
		<td><p align="left">位置：文章页头部文字广告</p></td>
	</tr>
	<tr>
		<td><label for="Ad3"><p align="center">广告位3</p></label></td>
		<td><p align="left"><textarea name="Ad3" type="text" id="Ad3" style="width:98%;"><?php echo $zbp->Config('crocodile')->Ad3;?></textarea></p></td>
		<td><p align="center"><input type="text" id="DisplayAd3" name="DisplayAd3" class="checkbox" value="<?php echo $zbp->Config('crocodile')->DisplayAd3;?>" /></p></td>
		<td><p align="left">位置：文章页底部广告，930×92</p></td>
	</tr>
	<tr>
		<td><label for="Ad4"><p align="center">广告位4</p></label></td>
		<td><p align="left"><textarea name="Ad4" type="text" id="Ad4" style="width:98%;"><?php echo $zbp->Config('crocodile')->Ad4;?></textarea></p></td>
		<td><p align="center"><input type="text" id="DisplayAd4" name="DisplayAd4" class="checkbox" value="<?php echo $zbp->Config('crocodile')->DisplayAd4;?>" /></p></td>
		<td><p align="left">位置：无</p></td>
	</tr>
	<tr>
		<td><label for="Ad5"><p align="center">广告位5</p></label></td>
		<td><p align="left"><textarea name="Ad5" type="text" id="Ad5" style="width:98%;"><?php echo $zbp->Config('crocodile')->Ad5;?></textarea></p></td>
		<td><p align="center"><input type="text" id="DisplayAd5" name="DisplayAd5" class="checkbox" value="<?php echo $zbp->Config('crocodile')->DisplayAd5;?>" /></p></td>
		<td><p align="left">位置：无</p></td>
	</tr>
	<tr>
		<td><label for="Ad6"><p align="center">广告位6</p></label></td>
		<td><p align="left"><textarea name="Ad6" type="text" id="Ad6" style="width:98%;"><?php echo $zbp->Config('crocodile')->Ad6;?></textarea></p></td>
		<td><p align="center"><input type="text" id="DisplayAd6" name="DisplayAd6" class="checkbox" value="<?php echo $zbp->Config('crocodile')->DisplayAd6;?>" /></p></td>
		<td><p align="left">位置：无</p></td>
	</tr>
	</table>
	<br />
	<input name="" type="Submit" class="button" style="margin-top:10px;width:99%;padding:0 auto;" value="保存"/>
		</form>
<?php } if ($act == 'Slide') { $str = '<form action="save.php?type=flash" method="post">
                <table width="100%" border="1" class="tdCenter">
                <tr>
                    <th scope="col" width="5%" height="32" nowrap="nowrap">序号</th>
                    <th scope="col" width="25%">标题</th>
                    <th scope="col" width="25%">图片</th>
                    <th scope="col" width="25%">链接</th>
                    <th scope="col" width="5%">排序</th>
                    <th scope="col" width="5%">显示</th>
                    <th scope="col" width="10%">操作</th>
                </tr>';
        $str .= '<tr>';
        $str .= '<td align="center">0</td>';
        $str .= '<td><input type="text" class="sedit" name="title" value=""></td>';
        $str .= '<td><input type="text" class="sedit" name="img" value=""></td>';
        $str .= '<td><input type="text" class="sedit" name="url" value=""></td>';
        $str .= '<td><input type="text" name="order" value="99" style="width:40px"></td>';
        $str .= '<td><input type="text" class="checkbox" name="IsUsed" value="1" /></td>';
        $str .= '<td><input type="hidden" name="editid" value="">
                        <input name="add" type="submit" class="button" value="增加"/></td>';
        $str .= '</tr>';
        $str .= '</form>';
        $where = array(array('=','sean_Type','0'));
        $order = array('sean_IsUsed'=>'DESC','sean_Order'=>'ASC');
        $sql= $zbp->db->sql->Select($crocodile_Table,'*',$where,$order,null,null);
        $array=$zbp->GetListCustom($crocodile_Table,$crocodile_DataInfo,$sql);
        $i =1;
        foreach ($array as $key => $reg) {
            $str .= '<form action="save.php?type=flash" method="post" name="flash">';
            $str .= '<tr>';
            $str .= '<td align="center">'.$i.'</td>';
            $str .= '<td><input type="text" class="sedit" name="title" value="'.$reg->Title.'" ></td>';
            $str .= '<td style="float:left;"><input type="text" class="sedit" name="img" value="'.$reg->Img.'" ></td>';
			$str .= '<td style="float:right;"><img src="'.$reg->Img.'" width="95" height="41"></td>';
            $str .= '<td><input type="text" class="sedit" name="url" value="'.$reg->Url.'" ></td>';
            $str .= '<td><input type="text" class="sedit" name="order" value="'.$reg->Order.'" style="width:40px"></td>';
            $str .= '<td><input type="text" class="checkbox" name="IsUsed" value="'.$reg->IsUsed.'" /></td>';
            $str .= '<td nowrap="nowrap">
                        <input type="hidden" name="editid" value="'.$reg->ID.'">
                        <input name="edit" type="submit" class="button" value="修改"/>
                        <input name="del" type="button" class="button" value="删除" onclick="if(confirm(\'您确定要进行删除操作吗？\')){location.href=\'save.php?type=flashdel&id='.$reg->ID.'\'}"/>
                    </td>';
            $str .= '</tr>';
            $str .= '</form>';
            $i++;
        }
        $str .='</table>';
        echo $str;
    };
	
?>
 
</div>
</div>
<script type="text/javascript">
ActiveTopMenu("topmenu_crocodile");
</script> 
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>