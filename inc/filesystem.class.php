<?php
Class filesystem{
	protected $url;
	protected $fp;
	
	/**
	 * @name 构造函数
	 * @param 需要访问的文件夹路径 $url
	 */
	public function __construct($url='',$type='direct'){
		if(empty($url)){
			$this->url=ROOT_PATH;
		}else{
			$this->url=$url;
		}
		
		//根据操作改变url
		if($type=='upward'){
			$this->url=dirname($this->url);
		}
		
		$validity=$this->check_url_validity();
		if($validity){
			return true;
		}else{
			$this->show_error('非法文件夹路径');
		}
	}
	
	/**
	 * @name 获得当前文件夹路径
	 */
	public function get_url(){
		return $this->url;
	}
	
	/**
	 * @name 根据url获得当前文件列表
	 */
	public function get_file_list(){
		if($this->fp){
			$filelists=array();
			$i=0;
			while(false!==($file=readdir($this->fp))){
				if($file!='.' && $file!='..'){
					$filelists[$i]['filename']=$file;
					if(is_dir($this->url.'/'.$file)){
						$filelists[$i]['filetype']='folder';
					}else{
						$filelists[$i]['filetype']=get_extension($file);
					}
					$i++;
				}
			}
			return $filelists;
		}else{
			$this->show_error("文件目录句柄无效");
			return false; 
		}
	}
	
	/**
	 * @name 创建文件夹
	 * @param 文件夹名称 $folder_name
	 */
	public function create_folder($folder_name){
		
	}
	
	/**
	 * @name 删除文件夹
	 * @param 文件夹名称 $folder_name
	 */
	public function del_folder($folder_name){
		
	}
	
	/**
	 * @name 检查url的合法性,合法则打开url文件目录句柄
	 */
	protected function check_url_validity(){
		$this->fp=opendir($this->url);
		if($this->fp){
			return true;
		}else{
			$this->show_error('非法目录');
			return false;
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
		closedir($this->fp);
	}
}