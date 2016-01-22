<?php
/**
 * class config 
 * get the all config file value
 * @author lmx
 * @create time 2015-08-24 16:41:00
*/
class Config{
	private $C_Dir;
	public function __construct(){
		$this->C_Dir = BASEURL.DIRECTORY_SEPARATOR."config/";
	}
	/*
	 * function getConfig 
	 * @param $file string the config file name
	 * @param $key string the config key name
	 * @return $value void the config value string or array 
	*/
	public function getConfig($file,$key){
			if(file_exists($this->C_Dir.$file)){
				$config_array = include_once($this->C_Dir.$filer);
				return $config_array[$key];
			}
	}
}
?>