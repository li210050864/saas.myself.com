<?php
/*
 * Created on 2015年7月17日 下午6:01:48
 *
 * Class / file common.function.php
 * Author lmx
 */
 /**
 * get table's name
 * @return string count_from_20150715
 */
function getTableName(){
	$table_pre = "count_from_";
	$date = date("Ymd",time());
	return $table_pre.$date;
}

/**
 * get the log file name 
 */
function getLogName(){
	$log_pre = "access_timeon_";
	$date = date("Y_m_d",time());
	return $log_pre.$date.".log";
//	return "log.log";
}

/**
 * get the file all path
 */
 function getFilePath($file_path,$file_name){
 	return (substr($file_path,-1)=="/")?($file_path.$file_name):($file_path."/".$file_name);
 }
?>
