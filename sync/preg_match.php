<?php
/*
 * Created on 2015年7月17日 下午4:49:19
 *
 * Class / file preg_match.php
 * Author lmx
 */
 //preg test
// $line_content = '218.247.184.227 - - [17/Jul/2015:16:11:15 +0800] "GET /c.png?f=duba HTTP/1.1" 304 - "-" "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0"';
// $ip_reg = "/\d{3}\.\d{1,3}\.\d{1,3}/";
// preg_match($ip_reg,$line_content,$match_arr);
// $time_reg = "/\[\d{2}\/[a-zA-Z]{3}\/\d{4}:\d{2}:\d{2}:\d{2,4}\s\+\d{4}\]/";
// preg_match($time_reg,$line_content,$match_time_arr);
// $f_reg = "/\/c.png\?f=\w+\s/";
// preg_match($f_reg,$line_content,$match_f_arr);

//read file test
//$file_all_path = "log.log";
//$log_file_array = array();
//$tag = "\r\n";//行分隔符 注意这里必须用双引号
//if(file_exists($file_all_path) && is_readable($file_all_path)){
//	$content = "";//行内容
//    $_current = "";
//    $step= 1;
//    $tagLen = strlen($tag);
//    $start = 0;//起始位置
//    $i = 0;//计数器
//    $start_line = 20;
//    $handle = fopen($file_all_path,"r+");
//    while(!feof($handle)) {
//        fseek($handle, $start, SEEK_SET);
//        $_current = fread($handle,$step);
//        $content .= $_current;
//        $start += $step;
//        $substrTag = substr($content, -$tagLen);
//        if ($substrTag == $tag) {
//        	if($i>$start_line){
//        		$log_file_array[] = trim($content);
//        	}
//			$content = "";
//            $i++;
//        }
//    }
//    fclose($handle);
//}
//inset redis
include("myRedis.class.php");
$db_config = include("db.conf.php");
$mysql_conf = $db_config["mysql"];
$redis_conf = $db_config["redis"];
$myRedis = new myRedis($redis_conf["host"],$redis_conf["port"]);
$info = json_encode(array("ip"=>"192.168.0.1","from"=>"duba","time"=>time()));
$myRedis->redisLpush("count",$info);
?>
