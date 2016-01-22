<?php
/**
 * class load other class
 * @author lmx
 * @create time 2015-08-24 17:04:00
*/
class Load{
	public function __construct(){
	}
	public function loadConf($conf,$path=null){
		if(empty($path) || $path == "" || !$path){
			$path = BASEURL.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR;
		}else{
			$path .= (strpos($path,DIRECTORY_SEPARATOR)===false)?DIRECTORY_SEPARATOR:"";
			$path = BASEURL.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR.$path;	
		}
		if(file_exists($path.$conf.".conf.php")){
			return include_once $path.$conf.".conf.php";	
		}
	}
	/*
	 * load class file
	 * @param $class string The will load file class name
	 * @param $class_param Void The new class __construct param,
	 * the default value is null
	 * @param $path string The file path .default path is /project_path/lib,
	 * if the path is sub path default path，give the $path value
	 * @return object
	*/
	public function loadClass($class,$class_param=null,$path=null){
		if(empty($path) || $path == "" || !$path){
			$path = BASEURL.DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR;
		}else{
			$path .= (strpos($path,DIRECTORY_SEPARATOR)===false)?DIRECTORY_SEPARATOR:"";
			$path = BASEURL.DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR;	
		}
		if(file_exists($path.$class.".class.php")){
			include_once $path.$class.".class.php";	
			$class = ucfirst($class);
			return new $class($class_param);
		}
	}
}
?>