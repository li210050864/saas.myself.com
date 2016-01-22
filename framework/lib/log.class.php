<?php
/*
 * class log 
*/
class Log{
		public function __construct(){
		}
		public function log_write($filename,$str){
			if(file_exists($filename)){
				$handle = fopen($filename,"a+");	
			}else{
				$handle = fopen($filename,"w+");	
			}
			$str .="\r\n";
			fwrite($handle,$str);	
		}
}
?>