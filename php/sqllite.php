<?php
// $db = new SQLite3("config.db");
// var_dump($db);
// $result = $db -> query("select * from host_title");
// var_dump($result);
// //SQLITE3_ASSOC
// while($row = $result -> fetchArray(SQLITE3_ASSOC)){
// 	echo "come in while";
// 	var_dump($row);
// }

$db2 = new SQLite3("softmgr.db");
var_dump($db2);
$result = $db2 -> query("select name from SQLITE_MASTER");
$result1 = $db2 -> query("select * from SoftwareType");
while($row = $result1 -> fetchArray(SQLITE3_ASSOC)){
	// var_dump($row);
	echo iconv("GBK","gb2312",$row['TypeName'])."<br />";
	echo iconv("gb2312","gbk",$row['TypeName'])."<br />";
	echo "**********<br />";
}
?>