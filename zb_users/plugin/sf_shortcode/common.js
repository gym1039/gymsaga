$(document).ready(function(){
	editor_api.editor.content.obj.ready(function(){
		var str='<link rel="stylesheet" rev="stylesheet" href="'+bloghost+'zb_users/plugin/sf_shortcode/common.css" type="text/css" media="all"/>';
		for(var i=0;i<window.frames.length;i++){
			$(window.frames[i].document.head).append(str);
		}
	});
});
var sf_shortcode_icon=[];
sf_shortcode_icon['绿色文本框']="background: #ecf2d6 url('"+bloghost+"zb_users/plugin/sf_shortcode/images/wpgo_sc_notice_mini.png') -1px -1px no-repeat !important;";
sf_shortcode_icon['红色文本框']="background: #ffecea url('"+bloghost+"zb_users/plugin/sf_shortcode/images/wpgo_sc_error_mini.png') -1px -1px no-repeat !important;";
sf_shortcode_icon['黄色文本框']="background: #fff4b9 url('"+bloghost+"zb_users/plugin/sf_shortcode/images/wpgo_sc_warn_mini.png') -1px -1px no-repeat !important;";
sf_shortcode_icon['灰色文本框']="background: #eaeaea url('"+bloghost+"zb_users/plugin/sf_shortcode/images/wpgo_sc_tips_mini.png') -1px -1px no-repeat !important;";
sf_shortcode_icon['蓝色标题']="background: #eaeaea url('"+bloghost+"zb_users/plugin/sf_shortcode/images/bt.png') -1px -1px no-repeat !important;";
sf_shortcode_icon['普通标题']="background: #eaeaea url('"+bloghost+"zb_users/plugin/sf_shortcode/images/t.png') -1px -1px no-repeat !important;";
UE.registerUI('绿色文本框 红色文本框 黄色文本框 灰色文本框 蓝色标题 普通标题', function(editor, uiname) {
    var btn = new UE.ui.Button({
        name: uiname,
        title: uiname,
        cssRules: sf_shortcode_icon[uiname],
        //点击时执行的命令
        onclick: function() {
			var range = editor.selection.getRange();
			range.select();
			var txt = editor.selection.getText();
			if(txt==null || txt==""){
				txt="<br/>";
			}
			editor.execCommand('insertHtml', '<p class="'+uiname+'">'+txt+'</p>');
        }
    });
    return btn;
});
