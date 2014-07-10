<?php
require 'inc/init.php';
/*
file_put_contents("output.txt",stripslashes($_POST['filecontent']));
exit;
*/
if($_GET['action']=='write_file'){
	$file=new File($_POST['filepath']);
	
	$filecontent=stripslashes($_POST['filecontent']);
	
	if($_POST['filecode']!='UTF-8'){
		$filecontent=iconv('UTF-8', $_POST['filecode'], $filecontent);
	}
	
	$res=$file->write_file($filecontent);
	
	if($res){
		echo '<script type="text/javascript">alert("Save Successfully");history.back();</script>';
	}
	exit;
}

if($_GET['action']=='create_folder'){
	
	$file_system=new Filesystem($_POST['filepath']);
	
	$res=$file_system->create_folder($_POST['filename']);
	
	return $res;
	exit;
}

if($_GET['action']=='create_file'){

	$file_system=new Filesystem($_POST['filepath']);

	$res=$file_system->create_file($_POST['filename']);

	if($res){
		echo 'true';
	}else{
		echo 'false';
	}
	exit;
}

if($_GET['action']=='del_file'){
	$file_system=new Filesystem($_POST['filepath']);
	
	$res=$file_system->del_file($_POST['filename']);
	
	if($res){
		echo 'true';
	}else{
		echo 'false';
	}
	exit;
}