{template:header}

<div id="main-content">
	{template:content-header}

	<div class="container-fluid">
		<div class="row-fluid">
			
			<div class="span12">
			
				<div class="widget-box">
					<article id="post-18975" class="widget-content single-post">
						<header id="post-header">
						
							<h1 class="post-title" itemprop="headline">
								{$article.Title}
							</h1>
						</header>
						
						<div class="entry" itemprop="articleBody">
							{$article.Content}
						</div>
						
					</article>
				</div>

				<div class="widget-box">
					{template:comments}
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end: content -->
{template:footer}