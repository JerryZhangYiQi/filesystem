<?php 
require 'inc/init.php';
if(empty($_POST['url'])){
	$filesystem=new Filesystem();
}else{
	$filesystem=new Filesystem($_POST['url'],$_POST['type']);
}
	$filelist=$filesystem->get_file_list();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>简易文件系统</title>
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<link rel="stylesheet" type="text/css" href="css/basic_style.css" />
<link rel="stylesheet" type="text/css" href="css/hidden_div.css" />
<script type="text/javascript" src="js/jquery-1.11.0.js"></script>
</head>
<body>
	<div id="header">
		<div id="header_body">
			<div id="header_button">
				<span class="header_button_content" id="header_button_forback">后退</span>
				<span class="header_button_content" id="header_button_upward">向上</span>
				<span class="header_button_content">上传</span>
				<span class="header_button_content">下载</span>
				<span class="header_button_content">删除</span>
				<span class="header_button_content" id="header_button_return_root">返回根目录</span>
				<span class="header_button_content" id="header_button_createfile">创建新文件</span>
			</div>
			<form id="address_form" action="index.php" method="post">
				<div id="header_address">
					<span id="header_address_title">地址:</span>
					<span id="header_address_contentner">
						<input type="text" id="header_address_content" name='url' value="<?php echo $filesystem->get_url();?>" />
						<input type="hidden" id="header_address_type" name="type" value="direct" />
					</span>
					<input type="submit" value="转至" id="header_address_button" />
				</div>
			</form>
		</div>
	</div>
	<div id="files_filter">
		<p id="files_filter_name">过滤规则</p>
		<span class="files_filter_title">文件名:</span>
		<input class="files_filter_content" id="files_filter_filename" />
		<span class="files_filter_title">文件类型:</span>
		<input class="files_filter_content" id="files_filter_filetype" />
	</div>
	<div id="content_body">
		<input type="hidden" id="url" name="url" value="<?php echo $filesystem->get_url();?>" />
		<div id="filelist_container">
			<form action="file_edit.php" method="post" id="file_edit_form" target="_blank">
				<table id="filelist">
					<tr>
						<th class="selectbox">&nbsp;</th>
						<th class="filename">文件名</th>
						<th class="filetype">文件类型</th>
						<th class="operation_container">操作</th>
					</tr>
					<?php
						foreach ($filelist as $k=>$v){
						?>
							<tr class="<?php echo $t=($k%2==1)?'odd':'even';?> file_tr">
								<td class="selectbox"><input type="checkbox" class="selected_file" name="selected_file[]" /></td>
								<td class="filename"><?php echo $v['filename']?></td>
								<td class="filetype"><?php echo $v['filetype']?></td>
								<td class="operation_container">
									<span class="operation_button del_file">删除</span>
									<span class="operation_button">重命名</span>
								</td>
								<input type="hidden" class="filetype" name="filetype" value="<?php echo $v['filetype']?>" />
							</tr>
						<?php 
						}
					?>
					<input type="hidden" id="file_edit_url" name="file_edit_url" val="" />
				</table>
			</form>
		</div>
	</div>
	<div id="footer">
		<p>Simple Web FileSystem	Write By:Jerry	Version:0.0.1</p>
	</div>
	<?php require 'hidden_div.html' ?>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/hidden_div.js"></script>
</body>
</html>