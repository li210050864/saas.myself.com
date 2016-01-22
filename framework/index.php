<?php
// The framework entrance file
define("BASEURL",dirname(__FILE__));
define("WEBHOST",$_SERVER["HTTP_HOST"]);
define("PROHOST","http://".WEBHOST.substr($_SERVER["PHP_SELF"],0,strrpos($_SERVER["PHP_SELF"],"/")));
$base_dir_array = include_once(BASEURL.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."base.conf.php");
define("CLASSDIR",array_key_exists("class_dir",$base_dir_array)?$base_dir_array["class_dir"]:"lib");
define("FUNCDIR",array_key_exists("func_dir",$base_dir_array)?$base_dir_array["func_dir"]:"func");
require_once(BASEURL.DIRECTORY_SEPARATOR.FUNCDIR.DIRECTORY_SEPARATOR."global.func.php");
$load_class = new Load();
$config_db_mysql = $load_class->loadConf("db")["mysql"];	
$db_class = $load_class->loadClass("db",$config_db_mysql);
?>