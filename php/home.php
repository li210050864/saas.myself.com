<?php
require_once("header.inc");
?>
<p>Welcome to the home of TLA Consulting.Please take some time to get to know us.</p>
<p>We specialize in serving your business needs and hope to hear from you soon.</p>
<?php
//phpinfo();
//fopen("myfile.txt","r");
//FOPEN("text.txt","w");
/*
global $name;
$name = "_getname";
function _getname($param){
	echo "come in function getname";
	echo "Number of parameters is :".func_num_args();
	echo "The parameter is ";
	$paramers_arr = func_get_args();
	$param_arr = func_get_arg(0);
	echo "<pre>";
	var_dump($paramers_arr);
	var_dump($param_arr);
	echo "</pre>";
	}
	$param = "new";
	$name($param);
	//check the function param area
	function _param(){
		$num = 3;
		echo "function inner num is :".$num;
		echo "function inner param is ".$param;
		}
		_param();
		echo "function out num is ".$num;
global $var;
$var = "contents 1";
function fn(){
	global $var;
	//$var = "contents";
	//echo "inside the function,\$var = ".$var."<br />";
	//$var = "contents 2";
	echo "inside the function,\$var = ".$var."<br />";
}
//$var = "contents 1";
fn();
echo "outside the function,\$var = ".$var."<br />";
//定义全局变量的缺点是：所有引用该函数的地方定义的变量名称必须和全局变量的名称相同
//参数的引用传递和值传递
$value = 10;
function increment(&$value,$amount=1){
	$value = $value+$amount;
	}
increment($value);
echo $value;
function reverse_r($str){
	if(strlen($str)>0){
		reverse_r(substr($str,1));
		}
		echo substr($str,0,1);
		return;
	}
function reverse_i($str){
	for($i = 1;$i<=strlen($str);$i++){
		echo substr($str,-$i,1);
		}
		return;
	}
	echo "<p>";
	reverse_r("Hello");
	echo "</p><p>";
	reverse_i("Hello");
	echo "</p>";
	//对象的概念：封装、继承、多态
	//类，抽象类，接口
	class A{
		function foo(){
			if(isset($this)){
				echo '$this is defined ( ';
				echo get_class($this);
				echo ")\n";
			}else{
				echo "\$this is not defined.\n";
				}
			}
		}
		class B{
			function bar(){
					A::foo();
				}
			}
			$a = new A();
			$a->foo();
			//A::foo();
			$b = new B();
			$b->bar();
			//B::bar();
$instance = new SimpleClass();
$calssName = "Foo";
$instance = new $className();
class Test{
	static public function getNew(){
		return new static;
		}
	}
class Child extends Test{
  }
$obj1 = new Test();
$obj2 = new $obj1;
var_dump($obj1 !== $obj2);
var_dump($obj1);
var_dump($obj2);
$obj3 = Test::getNew();
var_dump($obj3);
var_dump($obj3 instanceof Test);
$obj4 = Child::getNew();
var_dump($obj4 instanceof Test);
var_dump($obj4 instanceof Child);
*/
require_once("footer.inc");
?>