<?php
header("Content-Type: text/html; charset=UTF-8");
//代码重用 函数编写
// require_once("main.php");
// $val = getval();
// echo $val;

function test1(){
	echo "this is test1";
	$inner2 = function(){
		echo "come in inner2";
	};
	function inner(){
		echo "this is inner";
	}
	$inner2();
}

test1();
// inner();
// echo $inner2;
?>