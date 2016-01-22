<?php
/*
 * Created on 2015Äê7ÔÂ15ÈÕ
 * Author lmx
 * process file createTable 
 */
error_reporting(E_ALL & ~(E_NOTICE) & ~(E_WARNING));
include("mySql.class.php");
include("common.function.php");
$db_conf = include("db.conf.php");
$mysql_conf = $db_conf["mysql"];

$table = getTableName();
$columns_array = array(
	'id'=> array(
		'name' => 'id',
		'type' => 'int',
		'len'  => 11,
		),
	'from' => array(
		'name' => 'from',
		'type' => 'char',
		'len'  => 50,
	    ),
	'ip'  => array(
		'name' => 'ip',
		'type' => 'char',
		'len'  => 20,	
		),
	'time' => array(
		'name' => 'time',
		'type' => 'int',
		'len' => 11,
		),
);
$primary_key = "id";
$mySql_obj = new mySql($mysql_conf["host"],$mysql_conf["username"],$mysql_conf["password"],$mysql_conf["charset"],$mysql_conf["database"]);
$mySql_obj->mysqlCreateTable($table,$columns_array,$primary_key); 
?>
