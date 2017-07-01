<?php  include $this->GetTemplate('header');  ?>
<div id="main-content">
	<?php  include $this->GetTemplate('content-header');  ?>
	
	<div class="container-fluid">
		<div class="row-fluid">
			<section class="span8 archive-list">
				<div class="widget-box" role="main">
					<header id="archive-head">
						<h1 itemprop="headline">
							分类：<?php  echo $category->Name;  ?>
							<!--
							<a class="rss-cat-icon" title="订阅这个分类" href="http://www.wpdaxue.com/develop/feed">
								<i class="fa fa-rss fa-fw">
								</i>
							</a>
							-->
						</h1>
						<div class="archive-description">
							<p>
								<?php  echo $category->Intro;  ?>
							</p>
						</div>
					</header>
					
					<div class="widget-content">
						<ul>
						<?php  foreach ( $articles as $article) { ?>
							<li class="archive-thumb">
								<article>
									<h2>
										<a href="<?php  echo $article->Url;  ?>" title="链接到  <?php  echo $article->Title;  ?>" rel="bookmark">
											<?php  echo $article->Title;  ?>
										</a>
									</h2>
									
									<a class="pic float-left" href="<?php  echo $article->Url;  ?>" title="链接到  <?php  echo $article->Title;  ?>" rel="bookmark">
										<img class="lazy" src="<?php  echo GetArticleImg($article); ?>" alt="<?php  echo $article->Title;  ?>" width="330" height="200" style="display: block;">
									</a>
									<p>
										<?php  echo $article->Intro;  ?>
									</p>
									<p class="post-meta">
										<span>
											<i class="fa fa-user fa-fw">
											</i>
											<a href="<?php  echo $article->Url;  ?>" title="">
												<?php  echo $article->Author->Name;  ?>
											</a>
										</span>
										<span>
											<i class="fa fa-clock-o fa-fw">
											</i>
											<?php  echo $article->Time('Y/m/d');  ?>
										</span>
										<span>
											<i class="fa fa-eye fa-fw">
											</i>
											<?php  echo $article->ViewNums;  ?>
										</span>
										<span>
											<i class="fa fa-comment-o fa-fw">
											</i>
											<a href="http://www.wpdaxue.com/wordpress-plugin-inspector.html#respond">
												<?php  echo $article->CommNums;  ?>
											</a>
										</span>
										<span>
											<i class="fa fa-tags fa-fw"></i>
											<?php  foreach ( $article->Tags as $tag) { ?>
												<a href="<?php  echo $tag->Url;  ?>" rel="tag"> <?php  echo $tag->Name;  ?></a>
											<?php }   ?>
										</span>
									</p>
									<div class="clear">
									</div>
								</article>
							</li>
						<?php }   ?>	
						</ul>
						<?php  include $this->GetTemplate('pagebar');  ?>
						<div class="clear">
						</div>
					</div>
				</div>
			</section>
			<aside class="span4 sidebar-right hide-sidebar" role="complementary">
				<?php  include $this->GetTemplate('sidebar2');  ?>
			</aside>
		</div>
	</div>
</div>

<?php  include $this->GetTemplate('footer');  ?>