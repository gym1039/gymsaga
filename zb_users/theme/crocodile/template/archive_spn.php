{template:header}

<script src="{$host}zb_users/theme/{$theme}/script/tool.js" type="text/javascript"></script>
<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/tool.css"/>

<div id="main-content">
	{template:content-header}
	
	<div class="container-fluid">
		<div class="column clearfix">
			<h2>{$category.Name}</h2>
			
			{foreach $articles as $article} 		
			<div class="latestTool">
				<div class="toolDescription">
					<div>
						<img width="96" height="96" src="{php} echo GetArticleImg($article);{/php}" class="attachment-100x100 wp-post-image" alt="music">
					</div>
					<div class="t_title"><a href="{$article.Url}">{$article.Title} </a></div>
					<div class="intro">
					{php}$description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($article->Intro,'[nohtml]'),100)).'...');{/php}
					{$description}
					</div>
				</div>
				<div class="detail boxShadow" id="apidocs_detail" style="display: none;">
					<div>
						<a href="{$article.Url}">
							<img width="96" height="96" src="{php} echo GetArticleImg($article);{/php}" class="attachment-100x100 wp-post-image" alt="music">
						</a>
					</div>					
					<div class="t_title"><a href="{$article.Url}">{$article.Title}</a></div>
					<div class="detailIntro">
						{php}$description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),100)).'...');{/php}
						{$description}
					</div>
				</div>
			</div>
			{/foreach}	
			{template:pagebar}
		</div>
	</div>
	
</div>

{template:footer}