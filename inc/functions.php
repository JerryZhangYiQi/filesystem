<?php
//递归删除文件夹
function deldir($dir) {
	$dh=opendir($dir);
	while ($file=readdir($dh)) {
		if($file!="." && $file!="..") {
			$fullpath=$dir."/".$file;
			if(!is_dir($fullpath)) {
				unlink($fullpath);
			} else {
				deldir($fullpath);
			}
		}
	}

	closedir($dh);
	if(rmdir($dir)) {
		return true;
	} else {
		return false;
	}
}

//创建文件夹
function create_folders($dir){
	return is_dir($dir) or (create_folders(dirname($dir)) and mkdir($dir, 0777));
}

//获取文件扩展名
function get_extension($file)
{
	return pathinfo($file, PATHINFO_EXTENSION);
}

//获取文件名
function get_filename($file)
{
	return basename($file);
}

//检查字符串编码
function get_str_code($str){
	$arr=array('GB2312','GBK','UTF-8');
	foreach ($arr as $v){
		$t=iconv($v,$v, $str);
		if($t==$str){
			return $v;
		}
	}
	return false;
}