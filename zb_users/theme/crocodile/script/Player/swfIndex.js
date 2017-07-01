
var weburl="http://www.gymsaga.com/Tool/Res";

function test(){
	var swfObj = $("input[type='radio'][name='dewversion']:checked");
	var swf = $(swfObj).val();
	var musicMp3 = $("#mp3file").val();
	if(musicMp3 == ""){
		alert("请输入音乐地址");
		return;
	}
	
	var content = ' <object type="application/x-shockwave-flash" data="http://www.gymsaga.com/Tool/Res/'+swf+'.swf?mp3='+musicMp3+'&autostart=1&volume=100" width="240" height="20" id="dewplayer-rect"><param name="movie" value="http://www.gymsaga.com/Tool/Res'+swf+'.swf?mp3='+musicMp3+'&autostart=1&volume=100" /></object>';
	 art.dialog({
        title: '查看效果', 
        content: content
    });  
}

function create_html_code(){
	
	var swfObj = $("input[type='radio'][name='dewversion']:checked");
	var dewversion = $(swfObj).val()
	var musicMp3 = $("#mp3file").val();
	if(musicMp3 == ""){
		alert("请输入音乐地址");
		return;
	}
	var autostart = $("input[type='radio'][name='dewstart']:checked").val();
	var autoreplay = $("input[type='radio'][name='dewreplay']:checked").val();
	var volume = $("#dewvolume").val();
	var player = $(swfObj).parents("tr").find("object").eq(0);
	var width = $(player).attr("width");
	var height = $(player).attr("height");
    var content=" <textarea cols=\"140\"  rows=\"4\" style=\"margin: 10px 10px 10px; width: 440px; height: 77px;\"><embed style='' align=center src="+weburl+"/"+dewversion+".swf?mp3="+musicMp3+"&autostart="+autostart+"&autoreplay="+autoreplay+"&volume="+volume+"  width="+width+" height="+height+" type=application/x-shockwave-flash wmode='transparent' quality='high' ;><param name='wmode' value='transparent'> </embed></textarea><br>"+"请复制上面的代码到你所需要插入flash的地方，如博客，论坛等。";
        art.dialog({
        title: '成功生成代码！', 
        content: content
    });  
}

function create_code()
{
    var swfObj = $("input[type='radio'][name='dewversion']:checked");
	var dewversion = $(swfObj).val()
	var musicMp3 = $("#mp3file").val();
	if(musicMp3 == ""){
		alert("请输入音乐地址");
		return;
	}
	var autostart = $("input[type='radio'][name='dewstart']:checked").val();
	var autoreplay = $("input[type='radio'][name='dewreplay']:checked").val();
	var volume = $("#dewvolume").val();
	var player = $(swfObj).parents("tr").find("object").eq(0);
	var width = $(player).attr("width");
	var height = $(player).attr("height");
    var content=" <textarea cols=\"140\"  rows=\"4\" style=\"margin: 10px 10px 10px; width: 440px; height: 77px;\">"+weburl+"/"+dewversion+".swf?mp3="+musicMp3+"&autostart="+autostart+"&autoreplay="+autoreplay+"&volume="+volume+" </textarea><br>"+"请复制上面的代码到你所需要插入flash的地方，如论坛等。";
        art.dialog({
        title: '成功生成代码！', 
        content: content
    });  
}