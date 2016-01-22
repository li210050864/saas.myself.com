<?php
$m = new MongoClient("mongodb://192.168.224.131:27017");
var_dump($m);
$conn = $m->connect();
var_dump($conn);
$collection = $m->product;
var_dump($collection);
$order = $collection->order;
var_dump($order);
$rows = $order->find();
var_dump($rows);
foreach($rows as $key=>$row){
	var_dump($key);
	var_dump($row);	
}
?>