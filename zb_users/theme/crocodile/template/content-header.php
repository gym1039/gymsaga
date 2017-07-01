{if $type=='category'}
<div id="content-header">
	<div id="breadcrumb"> 
		<a href="{$host}" title="" class="tip-bottom" data-original-title="返回首页">
			<i class="fa fa-home fa-fw"></i>首页
		</a> 
		<i class="fa fa-angle-right fa-fw"></i> 
		<span class="current">{$category.Name}</span>
	</div>
</div>

{elseif $type=='index'&&$page=='1'}	
<div id="content-header">
	<div id="top-announce">
		<i class="fa fa-bullhorn fa-fw"></i>
		{$zbp->Config('crocodile')->Welcome}
	</div>
</div>

{elseif $type=='article'}	
<div id="content-header">
	<div id="breadcrumb"> 
		<a itemprop="breadcrumb" href="{$host}" title="" class="tip-bottom" data-original-title="返回首页">
			<i class="fa fa-home fa-fw"></i>首页
		</a>
		<i class="fa fa-angle-right fa-fw"></i> 
		<a itemprop="breadcrumb" href="{$article.Category.Url}">{$article.Category.Name}</a> 
		<i class="fa fa-angle-right fa-fw"></i> 
		<span class="current">正文</span>
	</div>	
</div>
{/if}

