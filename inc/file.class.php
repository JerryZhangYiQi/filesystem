<?php
Class File{
	protected $fp;
	protected $url;
	
	/**
	 * @name 构造函数
	 * @param 文件路径 $url
	 */
	public function __construct($url){
		if(empty($url)){
			$this->show_error('文件路径为空');
		}else if(is_file(!$url)){
			$this->show_error('不是合法文件路径');
		}else{
			$this->url=$url;
			return true;
		}
	}
	
	/**
	 * @name 读取文件内容
	 * 
	 */
	public function read_file(){
		$fp=fopen($this->url, 'r');
		if($fp){
			$str='';
			$buffer=1024;
			while (!feof($fp)){
				$str.=fread($fp, $buffer);
			}
			fclose($fp);
		}
		return $str;
	}
	
	/**
	 * @name 写文件内容
	 * 
	 */
	public function write_file($str){
		$fp=fopen($this->url,'w');
		if($fp){
			$res=fwrite($fp,$str);
			fclose($fp);
			return $res;
		}
	}
	
	/**
	 * @name 输出错误信息
	 * @param 错误信息提示文本 $errmsg
	 */
	protected function show_error($errmsg){
		echo '<script type="text/javascript">alert("'.$errmsg.'");history.back();</script>';
		exit;
	}
	
	/**
	 * @name 析构函数
	 */
	public function __destruct(){
		if($this->fp){
			fclose($this->fp);
		}
	}
}