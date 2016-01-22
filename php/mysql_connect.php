<?php
//error_reporting(0);
//ini_set('display_errors', 0);
//error_reporting(E_ERROR);
$host = "119.29.96.177:3307";
$username = "root";
$password = "king888";
$database = "saas";
$conn = mysql_connect($host,$username,$password);
if($conn){
	mysql_select_db($database);
	echo "connect the mysql service success";
}else{
	echo "connect the mysql service faild";
}
?>