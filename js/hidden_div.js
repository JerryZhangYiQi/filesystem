$(function(){
	$("body").on("click","div.hidden_div_container div.hidden_div_title span.close",function(){
		$(this).parent().parent().parent().css("display","none");
	});
});

function auto_reset(obj){
	var left_w=($(document).width()-$(obj).width())/2;
	var top_w=$('html').scrollTop()+($(window).height()-$(obj).height())/2;
	//alert("left_w="+left_w+"||top_w="+top_w);
	$(obj).css({"top":top_w+"px","left":left_w+"px"});
}