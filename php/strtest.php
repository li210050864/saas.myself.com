<?php
header("Content-Type: text/html; charset=UTF-8");
/*
var_dump($_POST);
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$feedback = trim($_POST['feedback']);
echo "Name Val:".$name."<br />";
echo "Email val:".$email."<br />";
echo "FeedBack val:".$feedback."<br />";
echo "FeedBack value:".nl2br($_POST['feedback']);
$toaddress = "li210050864@163.com";
$subject = "Feedback from web site";
$mailcontent = "Customer name :".$name."\n".
							 "Customer email :".$email."\n".
							 "Coustomer comments:\n".
							 $feedback."\n";
$fromaddress = "From:webserver@example.com";
mail($toaddress,$subject,$mailcontent,$fromaddress);
*/
//$order_count = 30;
//printf("Total amount of order is %'*-b%%",$order_count);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>String Email Send</title>
		<style type="text/css">
		*{font-family:"微软雅黑"}	
		</style>
	</head>
	<body>
		<h1>Feedback submitted</h1>
		<p>Your feedback has been sent.</p>
		<?php
		$str = "hello, my name is lmx, welcome to here.";
		$post_str2 = "This is \sew str"; 
		$replace = "大家好，这里是测试字符串的替换功能的函数，请大家积极配合，关于明星出通告的事宜，请大家重新计划，每一个单词的意思一定要仔细斟酌，谢谢，这里是娱乐百分百";
		$log_str = "Aug 05 10:10:54 Erased: mysql-devel";
		$log_str2 = "Aug 05 10:11:11 Erased: mysql-server";
		$log_str3 = "Aug 05 10:15:08 Updated: mysql-libs-5.1.73-5.el6_6.x86_64";
		$log_str4 = "Aug 05 10:15:08 Updated: mysql-5.1.73-5.el6_6.x86_64";
		$log_str5 = "Aug 05 10:15:10 Installed: mysql-server-5.1.73-5.el6_6.x86_64";
		$log_str6 = "Aug 05 10:15:10 Installed: mysql-devel-5.1.73-5.el6_6.x86_64";
		/*
		echo "<p>".ucfirst($str)."</p>";
		echo "<p>".ucwords($str)."</p>";
		$post_str = 'This is my new str "Hello","HELLO","TEST"';
		echo "<p>".addslashes($post_str)."</p>";
		echo "<p>".stripslashes(addslashes($post_str))."</p>";
		echo "<p>".addslashes($post_str2)."</p>";
		echo "<pre>";
		var_dump(get_magic_quotes_gpc());
		echo"</pre>";
		$token = strtok($str,"m");
		echo "<p>".$token."</p>";
		while("" != $token){
			$token = strtok("m");
			echo "<p>".$token."</p>";
		}
		echo "<pre>";
		var_dump(strcmp($str,$post_str2));
		var_dump(strcasecmp($post_str2,$str));
		var_dump(strnatcmp($str,$post_str2));
		echo "</pre>";
		echo "<p>".stristr($str,"Name")."</p>";
		echo "<p>".strpos($str,"m")."</p>";
		echo "<p>".strrpos($str,"m")."</p>";
		$replace_array = array("测试","单词","明星","娱乐");
		echo "<p>".str_replace($replace_array,"xx",$replace)."</p>";
		*/
		
		?>
	</body>
</html>