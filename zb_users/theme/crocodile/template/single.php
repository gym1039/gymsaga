{template:header}

<div id="main-content">
	{template:content-header}

	<div class="container-fluid">
		<div class="row-fluid">
			
			<div class="span8">
			
				<div class="widget-box">
					<article id="post-18975" class="widget-content single-post">
						<header id="post-header">
						
							<h1 class="post-title" itemprop="headline">
								{$article.Title}
							</h1>
							<div class="clear">
							</div>
							<p class="post-meta">
								<span class="time">
									<i class="fa fa-clock-o fa-fw">
									</i>
									{$article.Time('Y/m/d')}
								</span>
								<span class="eye">
									<i class="fa fa-eye fa-fw">
									</i>
									{$article.ViewNums}
								</span>
								<span class="comm">
									<i class="fa fa-comment-o fa-fw">
									</i>
									<a href="{$article.Url}#comments" title="{$article.Title}">
										{$article.CommNums}		
									</a>
								</span>
								{if $user.ID>0 }
								<span class="edit">
									<i class="fa fa-edit fa-fw">
									</i>
									<a href="{$host}zb_system/admin/edit.php?act=ArticleEdt&id={$article.ID}" title="{$article.Title}">
										编辑
									</a>
								</span>
								{/if}
							</p>
							<div class="clear">
							</div>
						</header>
						
						<div class="entry" itemprop="articleBody">
							<div class="gggpost-above">
								{if $zbp->Config('crocodile')->DisplayAd2 == 1 }
									{$zbp->Config('crocodile')->Ad2}	
								{/if}
							</div>
							{$article.Content}
						</div>
						<footer class="entry-meta">
							<p class="post-tag">
								标签：
								{foreach $article.Tags as $tag}<a href="{$tag.Url}">{$tag.Name}</a>{/foreach}
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
								{if $zbp->Config('crocodile')->DisplayAd3 == 1 }
									{$zbp->Config('crocodile')->Ad3}	
								{/if}
							</div>
							
							<div id="sponsor">
								<div name="dashmain" id="dash-main-id-87874a" class="dash-main-2 87874a-9.9"></div>
								<script type="text/javascript" charset="utf-8" src="http://www.dashangcloud.com/static/ds.js"></script>
								<div class="clear"></div> 
						   </div>
							
							<div id="author-box">
								<h3>
									<span>
										最后编辑于：{$article.Time('Y/m/d')}
									</span>
									作者： {$article.Author.Name}
								</h3>
								<div class="author-info">
									<div class="author-avatar">
										<img src="{$article.Author.Avatar}" class="avatar avatar-128" height="128" width="128" style="display: block;"> 
									</div>
										
								</div>
								<div class="author-description">
									<span class="spostinfo">
										{$article.Author.Intro}
										
									</span>
								</div>
								<div class="clear">
								</div>
							</div>
						
						</footer>

						<div class="post-navigation">
							<div class="post-previous">
								<a href="{$article.Prev.Url}" rel="prev">
									<span>上一篇：</span> {$article.Prev.Title}
								</a>
							</div>
							
							<div class="post-next">
								<a href="{$article.Next.Url}" rel="next">
									<span>下一篇：</span> {$article.Next.Title}
								</a>
							</div>
						</div>
						
					</article>
				</div>

				<section id="related-posts" class="widget-box">
					<h3>
						相关文章
					</h3>
					
					{$array=GetList(4,null,null,null,null,null,array('is_related'=>$article->ID));}
					<div class="widget-content">
						{foreach $array as $related}
						<div class="related-item">
							<div class="post-thumbnail">
								<a href="{$related.Url}" title="链接到{$related.Title}" rel="bookmark">
									<img class="lazy" src="{php}echo GetArticleImg($related);{/php}" alt="{$related.Title}" width="180" height="120">
								</a>
							</div>
							<!-- post-thumbnail /-->
							<a href="{$related.Url}" title="链接到{$related.Title}" rel="bookmark">
								{$related.Title}
							</a>
							<p class="post-meta">
								{$related.Time('Y/m/d')}
							</p>
						</div>
						{/foreach}
					
						<div class="clear">
						</div>
					</div>
				</section>
				<div class="widget-box">
					{template:comments}
				</div>
			</div>
			
			<aside class="span4 sidebar-right hide-sidebar" role="complementary">
				{template:sidebar3}
			</aside>
		</div>
	</div>
</div>
<!-- end: content -->
{template:footer}