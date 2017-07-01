$(document).ready(function(){
	$(".latestTool").mouseover(function(){
		$(".detail").hide();
		var detail = $(this).find(".detail");
		$(this).addClass("toolActive");
		detail.show();
		$(this).mouseout(function(){
			detail.hide();
			$(".toolActive").removeClass("toolActive");
		});
	});
	
});
