
{template:header}

<link rel="stylesheet" type="text/css" href="{$host}zb_users/theme/{$theme}/style/Player/addtocite.css" />
<link rel="stylesheet" type="text/css" href="{$host}zb_users/theme/{$theme}/style/Player/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="{$host}zb_users/theme/{$theme}/style/Player/bdsstyle.css" />
<link rel="stylesheet" type="text/css" href="{$host}zb_users/theme/{$theme}/style/Player/Style.css" />
	
<div id="main-content">
	<div class="container-fluid">
		<div class="row-fluid">
			<section class="span8 archive-list">
				<div class="widget-box" role="main">
					<header id="archive-head">
						<h1 itemprop="headline">
							{$article.Title}
						</h1>
						
					</header>
					
					<div class="widget-content">
					
						<form action="" method="post" name="form_config">
							<span>下方填写任意空间的MP3网络链接<br/><br/>
							*在多首播放版本的MP3 地址，用字符 |分隔文件的地址 <br/>
							如:{$host}/Dewplayer/mp3/test.mp3|{$host}/Dewplayer/mp3/test2.mp3</span>
							<p></p>
							<table>
								<tbody>
									<tr>
										<td>mp3网络地址：</td>
										<td><input name="mp3file" id="mp3file" type="text" value="" size="50"></td>
									</tr>
									<tr>
										<td>默认音量</td>
										<td><input name="dewvolume" type="text" id="dewvolume" value="100" size="6">%</td>
									</tr>
									<tr>
										<td>播放控制</td>
										<td>
											<input name="dewstart" type="radio" id="dewstart" value="1" checked="checked"> 自动播放
											<input name="dewstart" type="radio" id="dewstart" value="0"> 手动播放
										</td>
									</tr>
									<tr>
										<td>是否循环</td>
										<td>
											<input name="dewreplay" type="radio" value="1" checked="checked">循环播放
											<input name="dewreplay" type="radio" value="0">不循环
										</td>
									</tr>
									<tr>
										<td><strong>播放器样式：</strong></td>
									</tr>
									<tr>
										<td><input type="radio" name="dewversion" value="GymPlayer" checked="checked"> 经典样式</td>
										<td>
											<object type="application/x-shockwave-flash" data="{$host}zb_users/theme/{$theme}/style/Player/Res/GymPlayer.swf?mp3=http://musicdata.miqiu.com/mp3/txzq/kldy.mp3&autostart=0&volume=100" width="200" height="20" id="GymPlayer"><param name="wmode" value="Opaque"><param name="movie" value="GymPlayer.swf?mp3=http://musicdata.miqiu.com/mp3/txzq/kldy.mp3&amp;autostart=0&amp;volume=100"></object><br>
										</td>
									</tr>
									
									<tr>
										<td><input type="radio" name="dewversion" value="GymPlayer_mini"> 迷你样式</td>
										<td>
											<object type="application/x-shockwave-flash" data="{$host}zb_users/theme/{$theme}/style/Player/Res/GymPlayer_mini.swf?mp3=http://musicdata.miqiu.com/mp3/txzq/kldy.mp3&autostart=0&volume=100" width="160" height="20" id="GymPlayer-mini"><param name="wmode" value="Opaque"><param name="movie" value="GymPlayer_mini.swf?mp3=http://musicdata.miqiu.com/mp3/txzq/kldy.mp3&amp;autostart=0&amp;volume=100"></object><br>
										</td>
									</tr>
									<tr>
										<td><input type="radio" name="dewversion" value="GymPlayer_multi"> 多首播放</td>
										<td>
											<object type="application/x-shockwave-flash" data="{$host}zb_users/theme/{$theme}/style/Player/Res/GymPlayer_multi.swf?mp3=http://musicdata.miqiu.com/mp3/txzq/kldy.mp3&autostart=0&volume=100" width="240" height="20" id="GymPlayer-multi"><param name="wmode" value="Opaque"><param name="movie" value="GymPlayer_multi.swf?mp3=http://musicdata.miqiu.com/mp3/txzq/kldy.mp3&amp;autostart=0&amp;volume=100"></object><br>
										</td>

									</tr>
									<tr>
										<td><input type="radio" name="dewversion" value="GymPlayer_rect">多首新版</td>
										<td>
											<object type="application/x-shockwave-flash" data="{$host}zb_users/theme/{$theme}/style/Player/Res/GymPlayer_rect.swf?mp3=http://musicdata.miqiu.com/mp3/txzq/kldy.mp3&autostart=0&volume=100" width="240" height="20" id="GymPlayer-rect"><param name="movie" value="GymPlayer_rect.swf?mp3=http://musicdata.miqiu.com/mp3/txzq/kldy.mp3&amp;autostart=0&amp;volume=100"><param name="wmode" value="Opaque"></object><br>
										</td>

									</tr>

									<tr>
										<td colspan="2">
										<br>
											<input type="button" class="btn" value="生成flash代码" onclick="create_code()"><input type="button" class="btn" value="生成html代码" onclick="create_html_code()"><input type="button" class="btn" value="预览效果" onclick="test()"><input type="button" class="btn" value="帮助" onclick="javascript:window.open({$host});">
										</td>
									</tr>
								</tbody>
							</table>
						</form>
					

						{template:comments}
						<div id="right-side">
							<!-- Baidu Button BEGIN -->
							<script type="text/javascript" id="bdshare_js" data="type=slide&amp;img=2&amp;pos=right&amp;uid=6802247" ></script>
							<script type="text/javascript" id="bdshell_js"></script>
							<script type="text/javascript">
							document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
							</script>
							<!-- Baidu Button END -->
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>

<script src="{$host}zb_users/theme/{$theme}/script/Player/artDialog.min.js"></script>
<script src="{$host}zb_users/theme/{$theme}/script/Player/jquery.min.js"></script>
<script src="{$host}zb_users/theme/{$theme}/script/Player/swfIndex.js"></script>

{template:footer}
	


