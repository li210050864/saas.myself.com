<?php
/**
 * 文件上传处理类
*/
class Lfileup{

	private $filename;

	private $tmpfilename;

	private $filetype;

	private $filesize;

	private $allowfiletypes;

	private $allowfilesize;

	private $uploaddir;

	private $errorcodearr = array(
		'10001' => '文件类型错误',
		'10002' => '上传文件大小超出设定文件大小',
		'10003' => '没有上传文件',
		'10004' => '文件只有部分被上传',
		'10005' => '文件没有被上传',
		'10006' => '文件上传大小为0',
		'10007' => '上传发生未知异常',
	);

	/**
	 * 设置允许上传文件类型
	*/
	public function setFiletypes($type_str){
		$this->allowfiletypes = $type_str;
	}

	/*
	 * 设置允许上传文件的大小
	*/
	public function setFilesize($size = '2MB'){
		$this->allowfilesize = intval($size)."MB";
	}

	/**
	 * 设置上传文件的路径
	*/
	public function setUploaddir($dir = "/uploads"){
		if(!is_dir($dir)){
			$this->createFolder($dir);
		}
		$this->uploaddir = $dir;
	}

	/**
	 * 创建文件夹饼赋予权限
	*/
	private function createFolder($path){
		if(!file_exists($path)){
			$this->createFolder(dirname($path));
			mkdir($path,0777);
		}
	}
	/**
	 * 格式化上传文件的大小
	*/
	private function formatFilesize($filesize = null){
		if($filesize && $filesize!==null){
			$units = array('B','KB','MB','GB','TB');
			for($i = 0;$filesize > 1024 && $i<=4;$i++){
				$filesize /= 1024;
			}
		}
		return $filesize.$units[$i];
	}

	/**
	 * 检查上传文件大小是否超过允许上传文件大小
	 * @param $filesize int 上传文件大大小
	*/
	private function compareFilesize($filesize){
		$allowfilesize = intval($this->allowfilesize) * 1024 * 1024;
		if($allowfilesize < $filesize){
			return false;
		}
		return true;
	}
	/**
	 * 上传文件的新生成的文件名称
	*/
	private function createFilename(){
		return date("YmdHis").".".$this->filetype;
	}

	/**
	 * 检查文件类型
	*/
	private function checkFiletypes(){
		if($this->filetype){
			if(!(strpos($this->allowfiletypes,$this->filetype) === false)){
				return true;
			}
		}
		return false;
	}

	/**
	 * 图片上传功能
	*/
	public function upFile($fileObj){
		if(is_uploaded_file($fileObj['tmp_name'])){
			$fileInfo = $fileObj;
			if($fileInfo && is_array($fileInfo)){
				$this->filename = $fileInfo['name'];
				$this->filetype = substr($fileInfo['type'],strpos($fileInfo['type'],'/')+1);
				$this->filesize = $fileInfo['size'];
				$this->tmpfilename = $fileInfo['tmp_name'];
				if(!$this->compareFilesize($this->filesize)){
					return json_encode(array('error_code' => 10002,'error_msg' => $this->errorcodearr['10002']));
				}
				if(!$this->checkFiletypes()){
					return json_encode(array('error_code' => 10001,'error_msg' => $this->errorcodearr['10001']));
				}
				$error=$fileInfo["error"];
				if($error == 0){
					$newfilename = $this->createFilename();
					if(move_uploaded_file($this->tmpfilename, dirname(BASEPATH).$this->uploaddir."/".$newfilename)){
						return json_encode(array('result' => 0,'filepath'=>$this->uploaddir."/".$newfilename));
					}
				}else{
					switch($error){
						case 1:
						case 2:
							$error_msg = array('error_code' => 10003,'error_msg' => $this->errorcodearr['10003']);
						break;
						case 3:
							$error_msg = array('error_code' => 10004,'error_msg' => $this->errorcodearr['10004']);
						break;
						case 4:
							$error_msg = array('error_code' => 10005,'error_msg' => $this->errorcodearr['10005']);
						break;
						case 5:
							$error_msg = array('error_code' => 10006,'error_msg' => $this->errorcodearr['10006']);
						break;
						default:
							$error_msg = array('error_code' => 10007,'error_msg' => $this->errorcodearr['10007']);
						break;
					}
					return json_encode($error_msg);
				}
			}
		}else{
			return json_encode(array('error_code' => 10003,'error_msg' => $this->errorcodearr['10003']));
		}
	}

}
?>