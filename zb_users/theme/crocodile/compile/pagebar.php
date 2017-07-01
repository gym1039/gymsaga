<?php if ($pagebar) { ?>
<div class="page-nav">
	<span class="pages"> 1 of <?php  echo $pagebar->PageAll;  ?> </span>
	<?php  foreach ( $pagebar->buttons as $k=>$v) { ?>
		<?php if ($pagebar->PageNow==$k) { ?>
		<span class="current"> <?php  echo $k;  ?> </span>
		<?php }elseif($k=='››') {  ?>
		<a href="<?php  echo $v;  ?>" class="last" title="尾页 »">尾页 »</a>
		<?php }else{  ?>
		<a href="<?php  echo $v;  ?>" class="page" title="<?php  echo $k;  ?>"><?php  echo $k;  ?></a>
		<?php } ?>
	<?php }   ?>
</div>
<?php } ?>