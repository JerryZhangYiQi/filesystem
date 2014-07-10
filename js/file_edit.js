$(function(){
	//储存按钮
	$("body").on("click","#header_button_savefile",function(){
		file_form.submit();
	});
	
	//另存为按钮
	$("body").on("click","#header_button_saveanotherfile",function(){
		
	});
});

var file_form=$("#file_form");