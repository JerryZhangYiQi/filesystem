<?php 
require 'inc/init.php';
if(!empty($_POST['file_edit_url'])){
	$file_edit_url=$_POST['file_edit_url'];
	$file=new File($file_edit_url);
}else{
	exit;
}

$file_content=$file->read_file();
$encode=get_str_code($file_content);
if($encode!='UTF-8'){
	$utf8_content=iconv($encode, 'UTF-8', $file_content);
}else{
	$utf8_content=$file_content;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo get_filename($file_edit_url);?></title>
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<link rel="stylesheet" type="text/css" href="css/basic_style.css" />
<link rel="stylesheet" type="text/css" href="css/file_edit.css" />
<script type="text/javascript" src="js/jquery-1.11.0.js"></script>
</head>
<body>
	<div id="header">
		<div id="header_body">
			<div id="header_button">
				<span class="header_button_content">查找</span>
				<span class="header_button_content">替换</span>
				<span class="header_button_content" id="header_button_savefile">保存</span>
				<span class="header_button_content" id="header_button_saveanotherfile">另存为</span>
				<span class="header_button_content">下载</span>
				<span class="header_button_content">删除</span>
			</div>
			<form id="address_form" action="index.php" method="post">
				<div id="header_address">
					<span id="header_address_title">地址:</span>
					<span id="header_address_contentner">
						<?php echo $file_edit_url;?>
					</span>
				</div>
			</form>
		</div>
	</div>
	<div id="content_body">
		<form action="file_action?action=write_file" method="post" id="file_form">
			<textarea name="filecontent" id="code_editor"><?php echo htmlspecialchars($utf8_content);?></textarea>
			<input type="hidden" name="filepath" value="<?php echo $file_edit_url;?>" />
			<input type="hidden" name="filecode" value="<?php echo $encode;?>" />
		</form>
	</div>
	<div id="footer">
		<p>Simple Web FileSystem	Write By:Jerry	Version:0.0.1</p>
	</div>
<script type="text/javascript" src="js/file_edit.js"></script>
</body>
</html>