<?php  include $this->GetTemplate('header');  ?>

<div id="main-content">
	<?php  include $this->GetTemplate('content-header');  ?>

	<div class="container-fluid">
		<div class="row-fluid">
			
			<div class="span8">
			
				<div class="widget-box">
					<article id="post-18975" class="widget-content single-post">
						<header id="post-header">
						
							<h1 class="post-title" itemprop="headline">
								<?php  echo $article->Title;  ?>
							</h1>
							<div class="clear">
							</div>
							<p class="post-meta">
								<span class="time">
									<i class="fa fa-clock-o fa-fw">
									</i>
									<?php  echo $article->Time('Y/m/d');  ?>
								</span>
								<span class="eye">
									<i class="fa fa-eye fa-fw">
									</i>
									<?php  echo $article->ViewNums;  ?>
								</span>
								<span class="comm">
									<i class="fa fa-comment-o fa-fw">
									</i>
									<a href="<?php  echo $article->Url;  ?>#comments" title="<?php  echo $article->Title;  ?>">
										<?php  echo $article->CommNums;  ?>		
									</a>
								</span>
								<?php if ($user->ID>0 ) { ?>
								<span class="edit">
									<i class="fa fa-edit fa-fw">
									</i>
									<a href="<?php  echo $host;  ?>zb_system/admin/edit.php?act=ArticleEdt&id=<?php  echo $article->ID;  ?>" title="<?php  echo $article->Title;  ?>">
										编辑
									</a>
								</span>
								<?php } ?>
							</p>
							<div class="clear">
							</div>
						</header>
						
						<div class="entry" itemprop="articleBody">
							<div class="gggpost-above">
								<?php if ($zbp->Config('crocodile')->DisplayAd2 == 1 ) { ?>
									<?php  echo $zbp->Config('crocodile')->Ad2;  ?>	
								<?php } ?>
							</div>
							<?php  echo $article->Content;  ?>
						</div>
						<footer class="entry-meta">
							<p class="post-tag">
								标签：
								<?php  foreach ( $article->Tags as $tag) { ?><a href="<?php  echo $tag->Url;  ?>"><?php  echo $tag->Name;  ?></a><?php }   ?>
							</p>
							
							<div class="bdsharebuttonbox">
								
								<a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
								<a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
								<a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
								<a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
								<a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
								<a href="#" class="bds_more" data-cmd="more"></a>
							</div>
							
							<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
							
							
							<div class="ggpost-below"> 
								<?php if ($zbp->Config('crocodile')->DisplayAd3 == 1 ) { ?>
									<?php  echo $zbp->Config('crocodile')->Ad3;  ?>	
								<?php } ?>
							</div>
							
							<div id="sponsor">
								<div name="dashmain" id="dash-main-id-87874a" class="dash-main-2 87874a-9.9"></div>
								<script type="text/javascript" charset="utf-8" src="http://www.dashangcloud.com/static/ds.js"></script>
								<div class="clear"></div> 
						   </div>
							
							<div id="author-box">
								<h3>
									<span>
										最后编辑于：<?php  echo $article->Time('Y/m/d');  ?>
									</span>
									作者： <?php  echo $article->Author->Name;  ?>
								</h3>
								<div class="author-info">
									<div class="author-avatar">
										<img src="<?php  echo $article->Author->Avatar;  ?>" class="avatar avatar-128" height="128" width="128" style="display: block;"> 
									</div>
										
								</div>
								<div class="author-description">
									<span class="spostinfo">
										<?php  echo $article->Author->Intro;  ?>
										
									</span>
								</div>
								<div class="clear">
								</div>
							</div>
						
						</footer>

						<div class="post-navigation">
							<div class="post-previous">
								<a href="<?php  echo $article->Prev->Url;  ?>" rel="prev">
									<span>上一篇：</span> <?php  echo $article->Prev->Title;  ?>
								</a>
							</div>
							
							<div class="post-next">
								<a href="<?php  echo $article->Next->Url;  ?>" rel="next">
									<span>下一篇：</span> <?php  echo $article->Next->Title;  ?>
								</a>
							</div>
						</div>
						
					</article>
				</div>

				<section id="related-posts" class="widget-box">
					<h3>
						相关文章
					</h3>
					
					<?php  $array=GetList(4,null,null,null,null,null,array('is_related'=>$article->ID));;  ?>
					<div class="widget-content">
						<?php  foreach ( $array as $related) { ?>
						<div class="related-item">
							<div class="post-thumbnail">
								<a href="<?php  echo $related->Url;  ?>" title="链接到<?php  echo $related->Title;  ?>" rel="bookmark">
									<img class="lazy" src="<?php echo GetArticleImg($related); ?>" alt="<?php  echo $related->Title;  ?>" width="180" height="120">
								</a>
							</div>
							<!-- post-thumbnail /-->
							<a href="<?php  echo $related->Url;  ?>" title="链接到<?php  echo $related->Title;  ?>" rel="bookmark">
								<?php  echo $related->Title;  ?>
							</a>
							<p class="post-meta">
								<?php  echo $related->Time('Y/m/d');  ?>
							</p>
						</div>
						<?php }   ?>
					
						<div class="clear">
						</div>
					</div>
				</section>
				<div class="widget-box">
					<?php  include $this->GetTemplate('comments');  ?>
				</div>
			</div>
			
			<aside class="span4 sidebar-right hide-sidebar" role="complementary">
				<?php  include $this->GetTemplate('sidebar3');  ?>
			</aside>
		</div>
	</div>
</div>
<!-- end: content -->
<?php  include $this->GetTemplate('footer');  ?>