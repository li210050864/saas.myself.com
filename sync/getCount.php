<?php
/*
 * Created on 2015-07-15
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
error_reporting(E_ALL & ~(E_NOTICE) & ~(E_WARNING));
include('myRedis.class.php');
include('mySql.class.php');
include("common.function.php");
$db_config = include("db.conf.php");
$mysql_conf = $db_config["mysql"];
$redis_conf = $db_config["redis"];

$myRedis = new myRedis($redis_conf["host"],$redis_conf["port"]);
$mySql = new mySql($mysql_conf["host"],$mysql_conf["username"],$mysql_conf["password"],$mysql_conf["charset"],$mysql_conf["database"]);

//sych mysql data
while(1){
	$json_data = getRadisData($myRedis,"count");
	if($json_data){
		$table_name = getTableName();
		synchData($mySql,$table_name,$json_data);
	}
}

//functions
/**
 * get Redis bd data
 * @param object $redis_obj REDIS object
 * @param string $key need key name
 */
function getRadisData($redis_obj,$key){
 	$result = $redis_obj->redisRpop($key);
 	if($result){
 		return json_decode($result,true);
 	}
 	return false;
}

/**
 * data sych redis/mysql
 * @param object $mysql_obj MYSQL object
 * @param string $table insert table name
 * @param Array $data insert data
 */
function synchData($mysql_obj,$table,$data){
	return $mysql_obj->insertData($table,$data);
} 
?>
