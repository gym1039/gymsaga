{template:header}
<div id="main-content">
	{template:content-header}
	
	<div class="container-fluid">
		<div class="row-fluid">
			<section class="span8 archive-list">
				<div class="widget-box" role="main">
					<header id="archive-head">
						<h1 itemprop="headline">
							分类：{$category.Name}
							<!--
							<a class="rss-cat-icon" title="订阅这个分类" href="http://www.wpdaxue.com/develop/feed">
								<i class="fa fa-rss fa-fw">
								</i>
							</a>
							-->
						</h1>
						<div class="archive-description">
							<p>
								{$category.Intro}
							</p>
						</div>
					</header>
					
					<div class="widget-content">
						<ul>
						{foreach $articles as $article}
							<li class="archive-thumb">
								<article>
									<h2>
										<a href="{$article.Url}" title="链接到  {$article.Title}" rel="bookmark">
											{$article.Title}
										</a>
									</h2>
									
									<a class="pic float-left" href="{$article.Url}" title="链接到  {$article.Title}" rel="bookmark">
										<img class="lazy" src="{php} echo GetArticleImg($article);{/php}" alt="{$article.Title}" width="330" height="200" style="display: block;">
									</a>
									<p>
										{$article.Intro}
									</p>
									<p class="post-meta">
										<span>
											<i class="fa fa-user fa-fw">
											</i>
											<a href="{$article.Url}" title="">
												{$article.Author.Name}
											</a>
										</span>
										<span>
											<i class="fa fa-clock-o fa-fw">
											</i>
											{$article.Time('Y/m/d')}
										</span>
										<span>
											<i class="fa fa-eye fa-fw">
											</i>
											{$article.ViewNums}
										</span>
										<span>
											<i class="fa fa-comment-o fa-fw">
											</i>
											<a href="http://www.wpdaxue.com/wordpress-plugin-inspector.html#respond">
												{$article.CommNums}
											</a>
										</span>
										<span>
											<i class="fa fa-tags fa-fw"></i>
											{foreach $article.Tags as $tag}
												<a href="{$tag.Url}" rel="tag"> {$tag.Name}</a>
											{/foreach}
										</span>
									</p>
									<div class="clear">
									</div>
								</article>
							</li>
						{/foreach}	
						</ul>
						{template:pagebar}
						<div class="clear">
						</div>
					</div>
				</div>
			</section>
			<aside class="span4 sidebar-right hide-sidebar" role="complementary">
				{template:sidebar2}
			</aside>
		</div>
	</div>
</div>

{template:footer}