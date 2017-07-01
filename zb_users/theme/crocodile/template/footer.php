	<footer id="footer" class="row-fluid" role="contentinfo">
		{if $zbp->Config('crocodile')->sylink=="1"} 
		<div class="span12 footer-nav">
			<ul>
				{module:link}
			</ul>
		</div>
		{/if}
		<div class="span12 footer-info">
			{$zbp->Config('crocodile')->Tongji}	
		</div>
	</footer>
	<div class="returnTop" title="返回顶部">
		<span class="s"></span>
		<span class="b"></span>返回顶部"
	</div>
	<script type="text/javascript" defer="" src="{$host}zb_users/theme/{$theme}/script/autoptimize.js"></script>
	{$footer}
	</body>
</html>
<!-- hyper cache 2015-12-17 09:21:02 -->