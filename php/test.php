<?php
header("Content-Type: text/html; charset=UTF-8");
//echo "come in here";
//echo "<br />";
//echo date("H:i,jS F Y");
//echo "<br />";
//echo  <<<theEnd
//  come in herte the end sign is theEnd aa
//theEnd
//echo "<pre>";
//var_dump($GLOBALS);
//var_dump($_SERVER);
//var_dump($_FILES);
//var_dump($_ENV);
//echo "</pre>";
//$out = `ls -la`;
//echo "<pre>".$out."</pre>";
/*$str = "TIPI是一个开源项目，项目包含的内容有：
《深入理解PHP内核》
本站所有的PHP源代码
本项目相关的一些项目源代码
本站设计和使用的一些素材
我们的项目托管在github上:

http://github.com/reeze/tipi
欢迎fork, 如果只想下载《深入理解PHP内核》这本书，请点击页面右上部分的下载链接下载， 项目目前并没有完成所有的内容。";
echo "NOW:".microtime();
echo "<br />".$str."<br />";
echo "NOW2:".microtime();
$result = print("<br />".$str."<br />");
echo "NOW3:".microtime()."<br />";
echo $result;
*/
/*
$num1 = 'ff8856';
$num2 = intval($num1,16);
echo $num2;
*/
//file 操作
/*
$file ="orders.txt";
$userid = rand(1,20);
$code = rand(1000,9999);
$order_id = date("YmdHis").$userid.$code;
$time = date("Y-m-d H:i:s");
$name = "Jone";
$img = "./imagtes/001.jpg";
$status = 0;
$str = "ORDERID	TIME	NAME	IMG	USER	STATUS \r\n";
$str .= $order_id."		".$time."	".$name."		".$img."	".$userid."	".$status."\r\n";
$strlen = strlen($str);
$fp = fopen($file,'wb');
$lock_result = flock($fp,LOCK_EX);
if($fp){
	$result = fwrite($fp,$str,$strlen);
}
$unlock_result = flock($fp,LOCK_UN);
$c_result = fclose($fp);
$new_result = @fwrite($fp,"come in here");
//if(!$new_result){
//	echo "write file faild";
//}
readfile($file);
$fread = @fopen($file,"rb");
if($fread){
	flock($fread,LOCK_EX);
	//while(!feof($fread)){
		//$content = @fgets($fread);
		//echo $content."<br />";
	//	$content = fgetcsv($fread,"\r\n");
	//	var_dump($content);
	//}
	flock($fread,LOCK_UN);
}else{
	echo "file is not exist";
}*/
/*
$array = array(
	'name'   => 'JUone',
	'age'      => 30,
	'sex'      => 'W'
);
while($element = each($array)){
	echo  $element['key'] ."--".$element['value']."<br />";
}*/
/*
$arr_key = array(
	'Tires','Oil','Spark Plugs'
);
sort($arr_key);
var_dump($arr_key);
$arr = array(
	'Tires'   => 100,
	'Oil'       => 10,
	'Spark Plugs'  => 4,
);
asort($arr);
var_dump($arr);
ksort($arr);
var_dump($arr);
*/
/*
function compare($x,$y){
	if($x[2] == $y[2]){
		return 0;
	}elseif($x[2] < $y[2]){
		return -1;
	}else{
		return 1;
	}
}
$array = array(
	array('TIR','Tires',100),
	array('OIL','Oil',10),
	array('SPK','Spark Plugs',4)
);
*/
//usort($array,'compare');
//var_dump($array);
//shuffle($array);
//var_dump($array);
//array_reverse($array);
//var_dump($array);
/*
$arr = array();
for($i=10;$i>0;$i--){
	$new_val = array_push($arr,$i);
	var_dump($new_val);
}
var_dump($arr);
for($i=0;$i<10;$i++){
	$val = array_pop($arr);
	var_dump($val);
	var_dump($arr);
}*/
/*
$numbers = range(10,1);
var_dump($numbers);
$re_number = array_reverse($numbers);
var_dump($re_number);
*/
$name = array("赵薇","黄晓明","陈坤","李冰冰","范冰冰","周迅","李晨","章子怡","林心如","苏有朋","吴奇隆","赵薇","周迅","孙俪","黄晓明");
/*
while($n_val = each($name)){
	//var_dump($n_val);
	echo $n_val['value']."<br />";
	//var_dump(current($name));
	var_dump(next($name));
}
*/
/*
$time = $_SERVER['REQUEST_TIME'];
$val = pack("I1",$time);
echo $val,strlen($val)."字节\n";
getAscill($val);
$file = "test.text";
$handle = fopen($file,"wb+");
$val_new = $val."\r\n".$time;
fwrite($handle,$val_new);
//$new_val = unpack("I*",$val);
//var_dump($new_val);

function getAscill($str) {
    $arr = str_split ( $str );
    foreach ( $arr as $v ) {
        echo $v, "=", ord ( $v ), "\n";
    }
    echo "=============\r\n\r\n";
}
*/
//array_walk
/*
function my_print($value){
	echo strlen($value)."<br />";
}
//array_walk($name,'my_print');

function my_multiply($value,$key,$factor){
	$len =  strlen($value);
	$len *= $factor;
	echo $len."<br />";
	}
array_walk($name,'my_multiply',3);
*/
/*
echo count($name);
echo "<br />";
echo sizeof($name);
echo "<br />";
$arr_count = array_count_values($name);
var_dump($arr_count);
*/

?>