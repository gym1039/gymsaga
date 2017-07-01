{if $pagebar}
<div class="page-nav">
	<span class="pages"> 1 of {$pagebar.PageAll} </span>
	{foreach $pagebar.buttons as $k=>$v}
		{if $pagebar.PageNow==$k}
		<span class="current"> {$k} </span>
		{elseif $k=='››'}
		<a href="{$v}" class="last" title="尾页 »">尾页 »</a>
		{else}
		<a href="{$v}" class="page" title="{$k}">{$k}</a>
		{/if}
	{/foreach}
</div>
{/if}