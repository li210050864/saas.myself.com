<?php
/*
 * Created on 2015年7月17日 下午3:12:29
 *
 * Class / file sendRedis.php
 * Author lmx
 */
class sendRedis{
	private $file_path;
	private $redis_obj;
	private $mysql_obj;
	
	public function __construct(){
	}
	
	public function setFilepath($file_path){
		$this->file_path = $file_path;
	}
	
	public function setRedisobj($redis_obj){
		$this->redis_obj = $redis_obj;
	}
	
	public function setMysqlobj($mysql_obj){
		$this->mysql_obj = $mysql_obj;
	}
	
	public function getFilepath(){
		return $this->file_path;
	}
	
	public function getRedisobj(){
		return $this->redis_obj;
	}
	
	public function getMysqlobj(){
		return $this->mysql_obj;
	}
	/**
	 * 读取日志文件
	 * @param string $start_line  
	 */
	public function readLogfile($start_line = 0,$tag="\r\n",$step = 1){
		$log_file_array = array();
		$file_all_path = $this->getFilepath();
		echo $file_all_path;
		if(file_exists($file_all_path) && is_readable($file_all_path)){
			$content = "";//行内容
		    $_current = "";
		    $tagLen = strlen($tag);
		    $start = 0;//起始位置
		    $i = 0;//计数器
		    $handle = fopen($file_all_path,"r+");
		    while(!feof($handle)) {
		        fseek($handle, $start, SEEK_SET);
		        $_current = fread($handle,$step);
		        $content .= $_current;
		        $start += $step;
		        $substrTag = substr($content, -$tagLen);
		        if ($substrTag == $tag) {
		        	if($i>$start_line){
		        		$log_file_array[] = trim($content);
		        	}
					$content = "";
		            $i++;
		        }
		    }
		    fclose($handle);
		}
		return $log_file_array;
	}
	
	public function analyseLog($log_array = array()){
		$ip_reg = "/\d{3}\.\d{1,3}\.\d{1,3}/";
		$time_reg = "/\[\d{2}\/[a-zA-Z]{3}\/\d{4}:\d{2}:\d{2}:\d{2,4}\s\+\d{4}\]/";
		$f_reg = "/\/c.png\?f=\w+\s/";
		if(!empty($log_array)){
			$info_array = array();
			foreach($log_array as $key => $line_content){
				preg_match($ip_reg,$line_content,$match_id_arr);
				preg_match($time_reg,$line_content,$match_time_arr);
				preg_match($f_reg,$line_content,$match_f_arr);
				
				$ip_value = empty($match_id_arr)?"":$match_id_arr[0];
				$time_value = empty($match_time_arr)?0:strtotime(ltrim(rtrim($match_time_arr[0],']'),'['));
				$f_value = empty($match_f_arr)?"":ltrim($match_f_arr[0],"/c.png?f=");
				
				$info_array[] = array(
					'ip'   => $ip_value,
					'from' => $f_value,
					'time' => $time_value,
				);
			}
			return $info_array;
		}
		return false;
	}
	
	public function insertRedis($data_array,$key){
		if(!empty($data_array)){
			foreach($data_array as $value){
				$this->redis_obj->redisLpush($key,json_encode($value));
			}
			return true;
		}else{
			return false;
		}
	}
	
	public function getDataCount($table_name,$where=""){
		return $this->mysql_obj->getCount($table_name,$where);
	}
} 
?>
