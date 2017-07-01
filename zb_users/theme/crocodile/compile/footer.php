	<footer id="footer" class="row-fluid" role="contentinfo">
		<?php if ($zbp->Config('crocodile')->sylink=="1") { ?> 
		<div class="span12 footer-nav">
			<ul>
				<?php  if(isset($modules['link'])){echo $modules['link']->Content;}  ?>
			</ul>
		</div>
		<?php } ?>
		<div class="span12 footer-info">
			<?php  echo $zbp->Config('crocodile')->Tongji;  ?>	
		</div>
	</footer>
	<div class="returnTop" title="返回顶部">
		<span class="s"></span>
		<span class="b"></span>返回顶部"
	</div>
	<script type="text/javascript" defer="" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/autoptimize.js"></script>
	<?php  echo $footer;  ?>
	</body>
</html>
<!-- hyper cache 2015-12-17 09:21:02 -->