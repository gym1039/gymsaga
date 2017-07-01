<?php if ($type=='index'&&$page=='1') { ?>	
	<title><?php  echo $name;  ?> | <?php  echo $subname;  ?></title>
	<meta name="description" content="<?php  echo $zbp->Config('crocodile')->Description;  ?>" />
	<meta name="keywords" content="<?php  echo $zbp->Config('crocodile')->Keywords;  ?>" />
	
<?php }elseif($type=='page') {  ?>	
	<title><?php  echo $article->Category->Name;  ?> | <?php  echo $name;  ?></title>
	<meta name="description" content="<?php  echo $article->Category->Name;  ?>" />
	<meta name="keywords" content="<?php  echo $article->Category->Name;  ?>" />	
	
<?php }elseif($type=='category') {  ?>
	<title><?php  echo $category->Name;  ?> | <?php  echo $name;  ?></title>
	<meta name="description" content="<?php  echo $category->Intro;  ?>" />
	<meta name="keywords" content="<?php  echo $category->Name;  ?>" />
	
<?php }elseif($type=='tag') {  ?>	
	<title><?php  echo $tag->Name;  ?> | <?php  echo $name;  ?></title>
	<meta name="description" content="<?php  echo $tag->Name;  ?>" />
	<meta name="keywords" content="<?php  echo $tag->Name;  ?>" />
	
<?php }elseif($type=='author') {  ?>	
	<title><?php  echo $author->Name;  ?>发表的所有文章 | <?php  echo $name;  ?></title>
	<meta name="description" content="<?php  echo $author->Name;  ?>" />
	<meta name="keywords" content="<?php  echo $author->Name;  ?>发表的所有文章" />

<?php }elseif($type=='article') {  ?>	
	<title><?php  echo $article->Title;  ?> | <?php  echo $name;  ?></title>
	<meta name="description" content="<?php echo strip_tags($article->Intro) ?>" />
	<meta name="keywords" content="
	<?php  
		$keywords=''; 
		foreach($article->Tags as $tag){ 
			$keywords = $keywords . $tag->Name . ",";
		}
		echo $keywords;
	 ?>" />
	
<?php }else{  ?>
	<title><?php  echo $title;  ?> | <?php  echo $name;  ?> </title>
 	<meta name="description" content="<?php  echo $title;  ?>_<?php  echo $name;  ?>_当前是第<?php  echo $pagebar->PageNow;  ?>页" />
	<meta name="keywords" content="<?php  echo $title;  ?>,<?php  echo $name;  ?>" /> 
<?php } ?>