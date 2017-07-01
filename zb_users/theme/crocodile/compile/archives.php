<?php  include $this->GetTemplate('header');  ?>

<div id="main-content">
	<?php  include $this->GetTemplate('content-header');  ?>

	<div class="container-fluid">
		<div class="row-fluid">
			
			<div class="span12">
			
				<div class="widget-box">
					<article id="post-18975" class="widget-content single-post">
						<header id="post-header">
						
							<h1 class="post-title" itemprop="headline">
								<?php  echo $modules['archives']->Name;  ?>
							</h1>
						</header>
						
						<div class="entry" itemprop="articleBody">
							<?php  echo $modules['archives']->Content;  ?>
						</div>
						
					</article>
				</div>

				<div class="widget-box">
					<?php  include $this->GetTemplate('comments');  ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end: content -->
<?php  include $this->GetTemplate('footer');  ?>