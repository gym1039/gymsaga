{if $type=='index'&&$page=='1'}	
	<title>{$name} | {$subname}</title>
	<meta name="description" content="{$zbp->Config('crocodile')->Description}" />
	<meta name="keywords" content="{$zbp->Config('crocodile')->Keywords}" />
	
{elseif $type=='page'}	
	<title>{$article.Category.Name} | {$name}</title>
	<meta name="description" content="{$article.Category.Name}" />
	<meta name="keywords" content="{$article.Category.Name}" />	
	
{elseif $type=='category'}
	<title>{$category.Name} | {$name}</title>
	<meta name="description" content="{$category.Intro}" />
	<meta name="keywords" content="{$category.Name}" />
	
{elseif $type=='tag'}	
	<title>{$tag.Name} | {$name}</title>
	<meta name="description" content="{$tag.Name}" />
	<meta name="keywords" content="{$tag.Name}" />
	
{elseif $type=='author'}	
	<title>{$author.Name}发表的所有文章 | {$name}</title>
	<meta name="description" content="{$author.Name}" />
	<meta name="keywords" content="{$author.Name}发表的所有文章" />

{elseif $type=='article'}	
	<title>{$article.Title} | {$name}</title>
	<meta name="description" content="{php}echo strip_tags($article->Intro){/php}" />
	<meta name="keywords" content="
	{php} 
		$keywords=''; 
		foreach($article->Tags as $tag){ 
			$keywords = $keywords . $tag->Name . ",";
		}
		echo $keywords;
	{/php}" />
	
{else}
	<title>{$title} | {$name} </title>
 	<meta name="description" content="{$title}_{$name}_当前是第{$pagebar.PageNow}页" />
	<meta name="keywords" content="{$title},{$name}" /> 
{/if}