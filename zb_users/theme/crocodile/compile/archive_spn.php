<?php  include $this->GetTemplate('header');  ?>

<script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/tool.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/tool.css"/>

<div id="main-content">
	<?php  include $this->GetTemplate('content-header');  ?>
	
	<div class="container-fluid">
		<div class="column clearfix">
			<h2><?php  echo $category->Name;  ?></h2>
			
			<?php  foreach ( $articles as $article) { ?> 		
			<div class="latestTool">
				<div class="toolDescription">
					<div>
						<img width="96" height="96" src="<?php  echo GetArticleImg($article); ?>" class="attachment-100x100 wp-post-image" alt="music">
					</div>
					<div class="t_title"><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?> </a></div>
					<div class="intro">
					<?php $description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($article->Intro,'[nohtml]'),100)).'...'); ?>
					<?php  echo $description;  ?>
					</div>
				</div>
				<div class="detail boxShadow" id="apidocs_detail" style="display: none;">
					<div>
						<a href="<?php  echo $article->Url;  ?>">
							<img width="96" height="96" src="<?php  echo GetArticleImg($article); ?>" class="attachment-100x100 wp-post-image" alt="music">
						</a>
					</div>					
					<div class="t_title"><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?></a></div>
					<div class="detailIntro">
						<?php $description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),100)).'...'); ?>
						<?php  echo $description;  ?>
					</div>
				</div>
			</div>
			<?php }   ?>	
			<?php  include $this->GetTemplate('pagebar');  ?>
		</div>
	</div>
	
</div>

<?php  include $this->GetTemplate('footer');  ?>