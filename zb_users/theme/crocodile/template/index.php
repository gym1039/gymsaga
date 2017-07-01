{template:header}

{if $type=='date'}	
	{template:date}
	{php}die();{/php}
{/if}

	<div id="main-content">
		{template:content-header}
		
		<div class="container-fluid home-fluid">
			<div class="row-fluid">
				<div class="span8">

					<!--幻灯片-->
					{module:slide}
							
					</div>
				</div>
				<div class="span4 home-ggg430">
					<div class="widget-box">
						<div class="widget-content">
							<div class="gright">
								{if $zbp->Config('crocodile')->DisplayAd1 == 1 }
									{$zbp->Config('crocodile')->Ad1}	
								{/if}
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
								{foreach GetList(10) as $newlist}
								<li>
									<span>
										{$newlist.Time('m-d')}
									</span>
									<a href="{$newlist.Url}" title="{$newlist.Title}" rel="bookmark">
										<i class="fa fa-angle-right">
										</i>
										{$newlist.Title}
									</a>
								</li>
								{/foreach}
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
								{php}
									$order = array('log_ViewNums'=>'DESC');
									$where = array(array('=','log_Status','0'));
									$array = $zbp->GetArticleList(array('*'),$where,$order,array(10),'');
								{/php}
								{foreach $array as $hotlist}
								
								<li class="other-news">
									<span>
										{$hotlist.ViewNums}℃
									</span>
									<a href="{$hotlist.Url}" title="{$hotlist.Title}" rel="bookmark">
										<i class="fa fa-angle-right"> </i>
										{$hotlist.Title}
									</a>
								</li>
								
								{/foreach}
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
								{php}
									$comments = $zbp->GetCommentList('*', array(array('=', 'comm_IsChecking', 0),array('<>', 'comm_AuthorID','1')), array('comm_PostTime' => 'DESC'), 3, null);
								{/php}
								
								{foreach $comments as $comment}
								
								<li class="other-news">
									<span>
										{$comment.Time('Y-m')}
									</span>
									<a href="{$comment.Post.Url}#cmt{$comment.ID}" title="{$comment.Post.Title}" rel="bookmark">
										<i class="fa fa-angle-right"> </i>
										{$comment.Author.Name}发表在{$comment.Post.Title}
									</a>
								</li>
								
								{/foreach}	
							</ul>
							<div class="clear"></div>
						</div>
						<!-- .cat-box-content /-->
					</div>
				</section>
				
				{php}
					$index=0;
	                $flids = explode(',',$zbp->Config('crocodile')->ciqucmsmk);
                {/php}
                
				{foreach $flids as $flid}
                {php}
					if($index %2 == 0 ) echo '<section class="span6 column2 first-column">';
					else echo '<section class="span6 column2">';
					$index++;
					$dbxscate=$zbp->GetCategoryByID($flid);
                {/php}
				
					<div class="widget-box">
						<div class="widget-title">
							<span class="more">
								<a target="_blank" href="{$dbxscate.Url}">
									更多
								</a>
							</span>
							<span class="icon">
								<i class="fa fa-book fa-fw">
								</i>
							</span>
							<h2>
								<a href="{$dbxscate.Url}">
									{$dbxscate.Name}
								</a>
							</h2>
						</div>
						<div class="widget-content">
							<ul>
								{php}
									$artcles=GetList(1,$flid);
								{/php}
								
								{foreach $artcles as $artcle}
								<li class="first-posts">
									<a class="post-thumbnail" href="{$artcle.Url}" title="链接到  {$artcle.Title}" rel="bookmark">
										<img class="lazy" src="{php} echo GetArticleImg($artcle);{/php}" alt="{$artcle.Title}" width="330" height="200" />
										<noscript>
											<img src="{php} echo GetArticleImg($artcle);{/php}" alt="{$artcle.Title}" width="330" height="200" />
										</noscript>
									</a>
									<h3>
										<a class="first-posts-title" href="{$artcle.Url}" title="链接到  {$artcle.Title}" rel="bookmark">
											{$artcle.Title}
										</a>
									</h3>
									<p class="summary">
										{php}$description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($artcle->Content,'[nohtml]'),100)).'...');{/php}
										{$description}
									</p>
									<p class="post-meta">
										<span>
											<i class="fa fa-clock-o fa-fw">
											</i>
											{$artcle.Time('Y/m/d')}
										</span>
										<span>
											<i class="fa fa-eye fa-fw">
											</i>
											{$artcle.ViewNums}
										</span>
										<span>
											<i class="fa fa-comment-o fa-fw">
											</i>
											<a href="{$artcle.Url}#respond">
												{$artcle.CommNums}
											</a>
										</span>
									</p>
								</li>
								
								<div class="clear">
								</div>
								{/foreach}
								
								{php}$dbxscate=GetList(9,$flid);{/php}
								{foreach $dbxscate as $key=>$artcle}
								{if $key>0}	
								<li class="other-news">
									<span>
										{$artcle.Time('m-d')}
									</span>
									<a href="{$artcle.Url}" title="{$artcle.Title}" rel="bookmark">
										<i class="fa fa-angle-right">
										</i>
										{$artcle.Title}
									</a>
								</li>
								{/if}
								{/foreach}
							</ul>
							<div class="clear">
							</div>
						</div>
						<!-- .cat-box-content /-->
					</div>
				</section>
				{/foreach}
				
			</div>
		</div>
	</div>

{template:footer}