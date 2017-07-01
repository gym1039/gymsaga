<?php if ($type=='category') { ?>
<div id="content-header">
	<div id="breadcrumb"> 
		<a href="<?php  echo $host;  ?>" title="" class="tip-bottom" data-original-title="返回首页">
			<i class="fa fa-home fa-fw"></i>首页
		</a> 
		<i class="fa fa-angle-right fa-fw"></i> 
		<span class="current"><?php  echo $category->Name;  ?></span>
	</div>
</div>

<?php }elseif($type=='index'&&$page=='1') {  ?>	
<div id="content-header">
	<div id="top-announce">
		<i class="fa fa-bullhorn fa-fw"></i>
		<?php  echo $zbp->Config('crocodile')->Welcome;  ?>
	</div>
</div>

<?php }elseif($type=='article') {  ?>	
<div id="content-header">
	<div id="breadcrumb"> 
		<a itemprop="breadcrumb" href="<?php  echo $host;  ?>" title="" class="tip-bottom" data-original-title="返回首页">
			<i class="fa fa-home fa-fw"></i>首页
		</a>
		<i class="fa fa-angle-right fa-fw"></i> 
		<a itemprop="breadcrumb" href="<?php  echo $article->Category->Url;  ?>"><?php  echo $article->Category->Name;  ?></a> 
		<i class="fa fa-angle-right fa-fw"></i> 
		<span class="current">正文</span>
	</div>	
</div>
<?php } ?>

