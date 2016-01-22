<?php
/*
 * Created on 2015年7月20日 上午8:23:33
 *
 * Class / file recordFrom.php
 * Author lmx
 */
include("sendRedis.class.php");
include("common.function.php");
include("myRedis.class.php");
include("mySql.class.php");

$db_config = include("db.conf.php");
$mysql_conf = $db_config["mysql"];
$redis_conf = $db_config["redis"];

$common_conf = include("common.conf.php");


$redis_obj = new myRedis($redis_conf["host"],$redis_conf["port"]);
$sql_obj = new mySql($mysql_conf["host"],$mysql_conf["username"],$mysql_conf["password"],$mysql_conf["charset"],$mysql_conf["database"]);
$sendRedis_obj = new sendRedis();

$table_name = getTableName();
$file_path = $common_conf["log_file_path"];
$file_name = getLogName();
$file_all_path = getFilePath($file_path,$file_name);
$tag = "\r\n";

$sendRedis_obj->setFilepath($file_all_path);
$sendRedis_obj->setRedisobj($redis_obj);
$sendRedis_obj->setMysqlobj($sql_obj);
$count_line = $sendRedis_obj->getDataCount($table_name);
$log_info_array = $sendRedis_obj->readLogfile($count_line,$tag,1);
if(count($log_info_array)>0){
	$info_array=$sendRedis_obj->analyseLog($log_info_array);
	$sendRedis_obj->insertRedis($info_array,"count");
}
?>
