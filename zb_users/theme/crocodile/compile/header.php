<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <?php  include $this->GetTemplate('seo');  ?>
		
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="Cache-Control" content="no-transform" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="renderer" content="webkit">
		<link rel='stylesheet' id='an_style-css' href='<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/style.css' type='text/css' media='all' />	
        <link rel='stylesheet' id='an_style-css' href='<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/2qHyADmDDdGA.css' type='text/css' media='all' />
        <link rel="shortcut icon" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/images/favicon.ico" title="Favicon" />
		<script src="<?php  echo $host;  ?>zb_system/script/md5.js" type="text/javascript"></script>
		<script type='text/javascript' src='//libs.baidu.com/jquery/1.8.3/jquery.min.js?ver=2.5'></script>
		<script src="<?php  echo $host;  ?>zb_system/script/common.js" type="text/javascript"></script>
		<script src="<?php  echo $host;  ?>zb_system/script/c_html_js_add.php" type="text/javascript"></script>
    </head><?php  echo $header;  ?>
	
	<body id="top" class="home blog chrome p-text-indent">
	<div id="top-part">
		<div id="top-bar" class="navbar navbar-inverse">
			<div id="logo">
				<hgroup itemscope itemtype="http://schema.org/WPHeader">
					<h1 class="logoimg">
						<a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>" rel="home"><?php  echo $name;  ?></a>
					</h1>
				</hgroup>
			</div>
			<ul class="nav user-nav">
				<?php if ($user->ID>0 ) { ?>
				<li class="dropdown" id="profile-messages">
					<a title="" href="<?php  echo $host;  ?>zb_system/cmd.php?act=logout" class="dropdown-toggle">
						<i class="icon icon-fixed-width icon-signin"></i>
						<span class="text">登出</span>
					</a>
				</li>
				<?php }else{  ?>			
				<li class="dropdown" id="profile-messages">
					<a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle popup-login">
						<i class="fa fa-sign-in fa-fw"></i>
						<span class="text">
							登录
						</span>
						<b class="caret">
						</b>
					</a>
					<ul class="dropdown-menu">
						<form class="user-login" name="loginform" action="#" method="post">
							<li>
								<i class="fa fa-user fa-fw"> </i>
								<input required="required" class="ipt" placeholder="用户名" type="text" id="edtUserName" name="edtUserName" value="" size="20" tabindex="1"/>
							</li>
							<li>
								<i class="fa fa-lock fa-fw"> </i>
								<input required="required" class="ipt" placeholder="密码" type="password" id="edtPassWord" name="edtPassWord" value="" size="20" tabindex="2"/>
							</li>
							<li>
								<input name="chkRemember" id="chkRemember" type="checkbox" checked="checked" value="forever" tabindex="3"/>
								记住我的登录信息
							</li>
							<li class="btn">
								<input class="login-btn" type="submit" id="btnPost" name="btnPost" value="登录" tabindex="4"/>
							</li>
							
							<input type="hidden" name="username" id="username" value=""/>
							<input type="hidden" name="password" id="password" value=""/>
							<input type="hidden" name="savedate" id="savedate" value="30"/>
							<input type="hidden" name="dishtml5" id="dishtml5" value="0"/>
						</form>
	
						<script type="text/javascript">
							$("#btnPost").click(function(){
								
								var strUserName=$("#edtUserName").val();
								var strPassWord=$("#edtPassWord").val();
								var strSaveDate=$("#savedate").val();

								if((strUserName=="")||(strPassWord=="")){
									alert("用户名和密码不能为空");
									return false;
								}
				
								$("#edtUserName").remove();
								$("#edtPassWord").remove();
		
								$("form").attr("action","zb_system/cmd.php?act=verify");
								$("#username").val(strUserName);
								$("#password").val(MD5(strPassWord));
								$("#savedate").val(strSaveDate);
							})

							$("#chkRemember").click(function(){
								$("#savedate").attr("value",$("#chkRemember").attr("checked")=="checked"?30:0);
							})


							if (!$.support.leadingWhitespace) {
								$("#dishtml5").val(1);
							alert("您还在用陈旧IE内核的浏览器么？请升级至支持HTML5的IE11吧!\r\n要不咱换个Chrome或Firefox试试(—.—||||");}
						</script>
					</ul>
				</li>
				<?php } ?>
				<li class="user-btn user-reg">
					<a class="popup-register" href="<?php  echo $zbp->Config('crocodile')->YLink;  ?>" title="QQ邮箱订阅" rel="nofollow">
						<i class="fa fa-key fa-fw">
						</i>
						<span class="text">
							邮件订阅
						</span>
					</a>
				</li>
				<li id="qqqun" class="other-nav">
					<a target="_blank" title="技术交流群" href="<?php  echo $zbp->Config('crocodile')->QGroup;  ?>" rel="nofollow">
						<i class="fa fa-group fa-fw">
						</i>
						加入Q群
					</a>
				</li>
				<?php  echo $zbp->Config('crocodile')->ToolBar;  ?>
			</ul>
			<div id="search">
				<div class="toggle-search">
					<i class="fa fa-search fa-white fa-fw">
					</i>
				</div>
				<div class="search-expand">
					<div class="search-expand-inner">
						<form method="post" class="searchform themeform" action="<?php  echo $host;  ?>zb_system/cmd.php?act=search" target="_blank">
							<div>
								<input type="hidden" name="s" value="17272507204457678449">
								<input type="text" class="search" name="q" onblur="if(this.value=='')this.value='输入内容并按回车键';" onfocus="if(this.value=='输入内容并按回车键')this.value='';" value="输入内容并按回车键"/>
								<button type="submit" id="submit-bt" title="搜索">
									<i class="fa fa-search">
									</i>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<header id="header" role="banner">
			<nav id="main-nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
				<a href="#" class="visible-phone">
					<i class="fa fa-align-justify fa-fw">
					</i>
					导航菜单
				</a>
				<ul>
					<li>
						<a href="<?php  echo $host;  ?>">
							<i class="fa fa-home fa-fw"></i>
							博客首页
						</a>
					</li> 
					
					<?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?>
				</ul>
				<div class="clear">
				</div>
			</nav>
		</header>
	</div>