<?php 

//最新文章
function NewArticle(){
	global $zbp;
	if(!isset($zbp->modulesbyfilename['crocodile_NewArticle'])){
		$t=new Module();
		$t->Name="最新文章";
		$t->FileName="crocodile_NewArticle";
		$t->Source="theme_crocodile";
		$t->SidebarID=0;
		$t->IsHideTitle=1;		
		
		$t->Content .='
			<div class="widget-box widget widget-posts">
				<div class="widget-title">
					<span class="icon">
						<i class="fa fa-list fa-fw">
						</i>
					</span>
					<h3>
						最新文章
					</h3>
				</div>
				<div class="widget-content">
					<ul>';
					
		foreach(GetList(5) as $newlist) {
			$t->Content .='
						<li>
							<div class="widget-thumb">
								<a class="post-thumbnail" href="'.$newlist->Url.'"title="链接到  '.$newlist->Title.'" rel="bookmark">
									<img class="lazy" src="'.GetArticleImg($newlist).'"
									alt="'.$newlist->Title.'" width="45" height="45" style="display: inline;">
								</a>
								<a href="'.$newlist->Url.'" title="'.$newlist->Title.'.">
									'.$newlist->Title.'
								</a>
								
								<span class="date">
									'.$newlist->Time('m-d').'
								</span>
							</div>
						</li>';
		}
		$t->Content .='
						</ul>
					<div class="clear"> </div>
				</div>
			</div>';
		$t->HtmlID="posts-list-widget-13";
		$t->Type="div";
		$t->Save();
	}
}

//热门文章
function HotArticle(){

	global $zbp;
	if(!isset($zbp->modulesbyfilename['crocodile_HotArticle'])){
		$t=new Module();
		$t->Name="热门文章";
		$t->FileName="crocodile_HotArticle";
		$t->Source="theme_crocodile";
		$t->SidebarID=0;
		$t->IsHideTitle=1;		
		
		$t->Content .='
			<div class="widget-box widget widget-posts">
				<div class="widget-title">
					<span class="icon">
						<i class="fa fa-list fa-fw">
						</i>
					</span>
					<h3>
						热门文章
					</h3>
				</div>
				<div class="widget-content">
					<ul>';
			
		$order = array('log_ViewNums'=>'DESC');
		$where = array(array('=','log_Status','0'));
		$array = $zbp->GetArticleList(array('*'),$where,$order,array(10),'');
		
		foreach($array as $newlist) {
			$t->Content .='
						<li class="most-favorited">
							<span class="fav-num">
								<i class="fa fa-eye fa-fw"></i> '.$newlist->ViewNums.'
							</span>
							
							<a href="'.$newlist->Url.'" title="'.$newlist->Title.'">'.$newlist->Title.'</a>
						</li>';
		}
		$t->Content .='
						</ul>
					<div class="clear"> </div>
				</div>
			</div>';
		$t->HtmlID="posts-list-widget-13";
		$t->Type="div";
		$t->Save();
	}
}

//评论最多
function MostComment(){
	global $zbp;
	if(!isset($zbp->modulesbyfilename['crocodile_MostCommente'])){
		$t=new Module();
		$t->Name="评论最多";
		$t->FileName="crocodile_MostCommente";
		$t->Source="theme_crocodile";
		$t->SidebarID=0;
		$t->IsHideTitle=1;		
		
		$t->Content .='
			<div class="widget-box widget widget-posts">
				<div class="widget-title">
					<span class="icon">
						<i class="fa fa-list fa-fw">
						</i>
					</span>
					<h3>
						评论最多
					</h3>
				</div>
				<div class="widget-content">
					<ul>';
		
		$order = array('log_CommNums'=>'DESC');
		$where = array(array('=','log_Status','0'));
		$array = $zbp->GetArticleList(array('*'),$where,$order,array(5),'');			
		
		foreach($array as $hotlist) {
			$t->Content .='
						<li>
							<div class="widget-thumb">
								<a class="post-thumbnail" href="'.$hotlist->Url.'"title="链接到  '.$hotlist->Title.'" rel="bookmark">
									<img class="lazy" src="'.GetArticleImg($hotlist).'"
									alt="'.$hotlist->Title.'" width="45" height="45" style="display: inline;">
								</a>
								<a href="'.$hotlist->Url.'" title="'.$hotlist->Title.'.">
									'.$hotlist->Title.'
								</a>
								
								<span class="date">
									'.$hotlist->Time('m-d').'
								</span>
							</div>
						</li>';
		}
		$t->Content .='
						</ul>
					<div class="clear"> </div>
				</div>
			</div>';
		$t->HtmlID="posts-list-widget-14";
		$t->Type="div";
		$t->Save();
	}	
}

//广告
function Advert(){
	global $zbp;
	if(!isset($zbp->modulesbyfilename['crocodile_Advert'])){
		$t=new Module();
		$t->Name="广告";
		$t->FileName="crocodile_Advert";
		$t->Source="theme_crocodile";
		$t->SidebarID=0;
		$t->IsHideTitle=1;	
		$t->Content ="";
		$t->HtmlID="posts-list-widget-15";
		$t->Type="div";
		$t->Save();
	}	
}
?>