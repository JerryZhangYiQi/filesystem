$(function(){
	//后退按钮
	$("body").on("click","#header_button_forback",function(){
		history.back();
	});
	
	//向上按钮
	$("body").on("click","#header_button_upward",function(){
		var url=$("#url").val();
		goto_address(url,'upward');
	});
	
	//返回根目录
	$("body").on("click","#header_button_return_root",function(){
		goto_address('','direct');
	});
	
	//点击表格行，如果是文件，进入文件修改，如果是目录，打开目录
	$("body").on("click","#filelist tr.file_tr td.filename",function(){
		if($(this).parent().find("input.filetype").val()=='folder'){
			var url=$("#url").val()+'/'+$(this).html();
			goto_address(url,'direct');
		}else{
			var url=$("#url").val()+'/'+$(this).html();
			edit_file(url);
		}
	});
	
	//文件过滤--文件名
	$("body").on("keyup","#files_filter_filename",function(){
		var search_str=$(this).val();
		var tr=$("#filelist tr.file_tr");
		for(var i=0;i<tr.length;i++)
		{
			if(search_str!=""){
				var str=$(tr[i]).find("td.filename").html();
				if(str.indexOf(search_str)>=0){
					$(tr[i]).css("display","auto");
				}else{
					$(tr[i]).css("display","none");
				}
			}else{
				$(tr[i]).css("display","auto");
			}
		}
	});
	
	//文件过滤--文件名
	$("body").on("keyup","#files_filter_filetype",function(){
		var search_str=$(this).val();
		var tr=$("#filelist tr.file_tr");
		for(var i=0;i<tr.length;i++)
		{
			if(search_str!=""){
				var str=$(tr[i]).find("td.filetype").html();
				if(str.indexOf(search_str)>=0){
					$(tr[i]).css("display","auto");
				}else{
					$(tr[i]).css("display","none");
				}
			}else{
				$(tr[i]).css("display","auto");
			}
		}
	});
	
	//显示创建新文件按钮
	$("body").on("click","#header_button_createfile",function(){
		$("#create_file").css("display","block");
		$("#display_current_url").html($("#header_address_content").val());
		auto_reset($("div.hidden_div"));
	});
	//创建新文件
	$("body").on("click","#create_file_button",function(){
		var filename=$("#create_filename").val(),
			filepath=$("#display_current_url").html();
		if(filename!=''){
			$.ajax({
				type	:	"POST",
				url		:	"file_action.php?action=create_file",
				data	:	{
					"filename"	:	filename,
					"filepath"	:	filepath
				},
				success	:	function(data){
					if(data=="true"){
						edit_file(filepath+"/"+filename);
						setTimeout("location.reload()",500);
					}else{
						alert("创建文件失败");
					}
				}
			});
		}else{
			alert('文件名不能为空');
			return false;
		}
	});
	
	//删除文件
	$("body").on("click","#filelist tr.file_tr td.operation_container span.del_file",function(){
		var filepath=$("#header_address_content").val(),
			filename=$(this).parent().siblings("td.filename").html(),
			tr=$(this).parent().parent();
		if(confirm("是否删除"+filename+"?")){
			$.ajax({
				type	:	"POST",
				url		:	"file_action.php?action=del_file",
				data	:	{
					"filepath"	:	filepath,
					"filename"	:	filename
				},
				success	:	function(data){
					if(data=='true'){
						$(tr).remove();
					}else{
						alert("删除文件失败");
					}
				}
			});
		}else{
			return false;
		}
	});
});
/* 访问文件夹 */
var address_form=$("#address_form");
var header_address_content=$("#header_address_content");
var header_address_type=$("#header_address_type");
function goto_address(url,type){
	$(header_address_content).val(url);
	$(header_address_type).val(type);
	address_form.submit();
}

/* 跳转编辑文件页面 */
var file_edit_url=$("#file_edit_url");
var file_edit_form=$("#file_edit_form");
function edit_file(url){
	$(file_edit_url).val(url);
	file_edit_form.submit();
}