<?php  include $this->GetTemplate('header');  ?>

<?php if ($type=='date') { ?>	
	<?php  include $this->GetTemplate('date');  ?>
	<?php die(); ?>
<?php } ?>

	<div id="main-content">
		<?php  include $this->GetTemplate('content-header');  ?>
		
		<div class="container-fluid home-fluid">
			<div class="row-fluid">
				<div class="span8">

					<!--幻灯片-->
					<?php  if(isset($modules['slide'])){echo $modules['slide']->Content;}  ?>
							
					</div>
				</div>
				<div class="span4 home-ggg430">
					<div class="widget-box">
						<div class="widget-content">
							<div class="gright">
								<?php if ($zbp->Config('crocodile')->DisplayAd1 == 1 ) { ?>
									<?php  echo $zbp->Config('crocodile')->Ad1;  ?>	
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<section class="span4 home-recent">
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon">
								<i class="fa fa-newspaper-o fa-fw">
								</i>
							</span>
							<h2>
								最近更新
							</h2>
						</div>
						
						<div class="widget-content">
							<ul class="news-list">
								<?php  foreach ( GetList(10) as $newlist) { ?>
								<li>
									<span>
										<?php  echo $newlist->Time('m-d');  ?>
									</span>
									<a href="<?php  echo $newlist->Url;  ?>" title="<?php  echo $newlist->Title;  ?>" rel="bookmark">
										<i class="fa fa-angle-right">
										</i>
										<?php  echo $newlist->Title;  ?>
									</a>
								</li>
								<?php }   ?>
							</ul>
						</div>
						<!-- .widget-content /-->
					</div>
				</section>
				<section class="span4 column2">
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon">
								<i class="fa fa fa-wordpress fa-fw fa-fw">
								</i>
							</span>
							<h2>
								最近更新
							</h2>
						</div>
						<div class="widget-content">
							<ul>
								<?php 
									$order = array('log_ViewNums'=>'DESC');
									$where = array(array('=','log_Status','0'));
									$array = $zbp->GetArticleList(array('*'),$where,$order,array(10),'');
								 ?>
								<?php  foreach ( $array as $hotlist) { ?>
								
								<li class="other-news">
									<span>
										<?php  echo $hotlist->ViewNums;  ?>℃
									</span>
									<a href="<?php  echo $hotlist->Url;  ?>" title="<?php  echo $hotlist->Title;  ?>" rel="bookmark">
										<i class="fa fa-angle-right"> </i>
										<?php  echo $hotlist->Title;  ?>
									</a>
								</li>
								
								<?php }   ?>
							</ul>
							<div class="clear">
							</div>
						</div>
						<!-- .cat-box-content /-->
					</div>
				</section>
				<!-- Three Columns -->
				<section class="span4 column2">
					<div class="widget-box">
						<div class="widget-title">
							<span class="icon">
								<i class="fa fa fa-lightbulb-o fa-fw fa-fw">
								</i>
							</span>
							<h2>
								最新评论
							</h2>
						</div>
						<div class="widget-content">
							<ul>
								<?php 
									$comments = $zbp->GetCommentList('*', array(array('=', 'comm_IsChecking', 0),array('<>', 'comm_AuthorID','1')), array('comm_PostTime' => 'DESC'), 3, null);
								 ?>
								
								<?php  foreach ( $comments as $comment) { ?>
								
								<li class="other-news">
									<span>
										<?php  echo $comment->Time('Y-m');  ?>
									</span>
									<a href="<?php  echo $comment->Post->Url;  ?>#cmt<?php  echo $comment->ID;  ?>" title="<?php  echo $comment->Post->Title;  ?>" rel="bookmark">
										<i class="fa fa-angle-right"> </i>
										<?php  echo $comment->Author->Name;  ?>发表在<?php  echo $comment->Post->Title;  ?>
									</a>
								</li>
								
								<?php }   ?>	
							</ul>
							<div class="clear"></div>
						</div>
						<!-- .cat-box-content /-->
					</div>
				</section>
				
				<?php 
					$index=0;
	                $flids = explode(',',$zbp->Config('crocodile')->ciqucmsmk);
                 ?>
                
				<?php  foreach ( $flids as $flid) { ?>
                <?php 
					if($index %2 == 0 ) echo '<section class="span6 column2 first-column">';
					else echo '<section class="span6 column2">';
					$index++;
					$dbxscate=$zbp->GetCategoryByID($flid);
                 ?>
				
					<div class="widget-box">
						<div class="widget-title">
							<span class="more">
								<a target="_blank" href="<?php  echo $dbxscate->Url;  ?>">
									更多
								</a>
							</span>
							<span class="icon">
								<i class="fa fa-book fa-fw">
								</i>
							</span>
							<h2>
								<a href="<?php  echo $dbxscate->Url;  ?>">
									<?php  echo $dbxscate->Name;  ?>
								</a>
							</h2>
						</div>
						<div class="widget-content">
							<ul>
								<?php 
									$artcles=GetList(1,$flid);
								 ?>
								
								<?php  foreach ( $artcles as $artcle) { ?>
								<li class="first-posts">
									<a class="post-thumbnail" href="<?php  echo $artcle->Url;  ?>" title="链接到  <?php  echo $artcle->Title;  ?>" rel="bookmark">
										<img class="lazy" src="<?php  echo GetArticleImg($artcle); ?>" alt="<?php  echo $artcle->Title;  ?>" width="330" height="200" />
										<noscript>
											<img src="<?php  echo GetArticleImg($artcle); ?>" alt="<?php  echo $artcle->Title;  ?>" width="330" height="200" />
										</noscript>
									</a>
									<h3>
										<a class="first-posts-title" href="<?php  echo $artcle->Url;  ?>" title="链接到  <?php  echo $artcle->Title;  ?>" rel="bookmark">
											<?php  echo $artcle->Title;  ?>
										</a>
									</h3>
									<p class="summary">
										<?php $description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($artcle->Content,'[nohtml]'),100)).'...'); ?>
										<?php  echo $description;  ?>
									</p>
									<p class="post-meta">
										<span>
											<i class="fa fa-clock-o fa-fw">
											</i>
											<?php  echo $artcle->Time('Y/m/d');  ?>
										</span>
										<span>
											<i class="fa fa-eye fa-fw">
											</i>
											<?php  echo $artcle->ViewNums;  ?>
										</span>
										<span>
											<i class="fa fa-comment-o fa-fw">
											</i>
											<a href="<?php  echo $artcle->Url;  ?>#respond">
												<?php  echo $artcle->CommNums;  ?>
											</a>
										</span>
									</p>
								</li>
								
								<div class="clear">
								</div>
								<?php }   ?>
								
								<?php $dbxscate=GetList(9,$flid); ?>
								<?php  foreach ( $dbxscate as $key=>$artcle) { ?>
								<?php if ($key>0) { ?>	
								<li class="other-news">
									<span>
										<?php  echo $artcle->Time('m-d');  ?>
									</span>
									<a href="<?php  echo $artcle->Url;  ?>" title="<?php  echo $artcle->Title;  ?>" rel="bookmark">
										<i class="fa fa-angle-right">
										</i>
										<?php  echo $artcle->Title;  ?>
									</a>
								</li>
								<?php } ?>
								<?php }   ?>
							</ul>
							<div class="clear">
							</div>
						</div>
						<!-- .cat-box-content /-->
					</div>
				</section>
				<?php }   ?>
				
			</div>
		</div>
	</div>

<?php  include $this->GetTemplate('footer');  ?>