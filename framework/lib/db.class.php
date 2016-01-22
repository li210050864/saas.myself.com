<?php
/*
 * db class class file
 * @author lmx 
 * @create time 2015-08-24 17:44
*/
class Db{
	private $pconnect;
	private $connect;
	/*
	 * 数据库类初始化，根据数据库驱动判断
	 * @param $dbconf void : string=>file path  array=>config array
	*/
	public function __construct($dbconf = null){
			if(is_string($dbconf)){
				if(file_exists($dbconf)){
					$dbconf = include_once($dbconf);
				}	
			}
			$driver = $dbconf['driver'];
		  $driver_file = BASEURL.DIRECTORY_SEPARATOR.CLASSDIR.DIRECTORY_SEPARATOR."driver".DIRECTORY_SEPARATOR.$driver.".class.php";
		  if(file_exists($driver_file)){
		  	include_once($driver_file);
		  	$driver = ucfirst($driver);
		  	$this->connect = new $driver($dbconf);
		  	return $this;
		  }else{
		  	$str = "The Driver ".$driver." class is not exists,Please make sure the driver is correct.";
		  	create_log($driver,$str);	
		  }
		  return false;
	}	
}
?>