<?php
//$m = new MongoClient("monogdb://say001:say001@192.168.224.121:27017/test");
//mongodb://localhost:27017/admin:admin/aaa
$m = new MongoClient("mongodb://say001:123456@192.168.224.121:27017/products");
$conn = $m->connect();
var_dump($m);
var_dump($conn);
$host_info=$m->getHosts();
var_dump($host_info);
$collection = $m->selectCollection("products","pic");
var_dump($collection);
/*
$db->insert($info);
$result = $db->find();
var_dump($result);
*/
?>