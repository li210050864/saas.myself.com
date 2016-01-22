<?php
/*
 * global function file
*/
require_once(BASEURL.DIRECTORY_SEPARATOR.CLASSDIR.DIRECTORY_SEPARATOR."load.class.php");
/*
 * function create_log
 * write log 
*/
if(!function_exists("create_log")){
	function create_log($filename,$str){
		$load_class = new Load();
		$log_class = $load_class->loadClass("log");
		$filename = date("Y-m-d")."_".$filename.".log";
		$log_class->log_write($filename,$str);	
	}	
}
/*
 * function show_message
 * show the error message
*/
if(!function_exists("show_message")){
	function show_message($str){	
		exit("<p>".$str."</p>");
	}	
}
?>