<?php
/*
 * Created on 2015年7月15日
 * class mySql
 * Author lmx
 */
class mySql {
	private $conn;
	private $host;
	private $username;
	private $password;
	private $charset;
	private $db;
	/**
	 * 设置mysql服务器的域名或IP
	 * @param $host mysql服务器的域名或IP 默认localhost
	 */
	public function setHost($host = "localhost"){
		$this->host = $host;
	}
	/**
	 * 设置mysql服务器的连接用户名
	 * @param $username 用户名 默认为 root
	 */
	public function setUsername($username = "root"){
		$this->username = $username;
	}
	/**
	 * 设置mysql服务器连接密码
	 * @param $password 密码 默认为空
	 */
	public function setPassword($password = ""){
		$this->password = $password;
	}
	/**
	 * 设置mysql服务器的编码
	 * @param $charser 数据库编码 默认 utf8
	 */
	public function setCharset($charset = "utf8"){
		$this->charset = $charset;
	}
	/**
	 * 设置数据库
	 * @param $db 数据库名称
	 */
	public function setDb($db = ""){
		$this->db = $db;
	}
	/**
	 * 构造函数，完成数据库的连接
	 */
	public function __construct($host="localhost",$username="root",$password="",$charset ="",$db=""){
		$this->setHost($host);
		$this->setUsername($username);
		$this->setPassword($password);
		$this->setCharset($charset);
		$this->setDb($db);
		if($this->conn = mysqli_connect($this->host,$this->username,$this->password,$this->db)){
			$this->conn->query("SET NAMES ".$this->charset);
		}
	}
	/**
	 * 创建表
	 * @param string $table 表名
	 * @param Array $columns 列信息【名称，类型，长度】
	 * @param string $primary_key 主索引名称
	 */
	public function mysqlCreateTable($tablename,$columns,$primary_key){
		if($tablename==""){
			return false;
		}
		$sql = "CREATE TABLE IF NOT EXISTS `".$tablename."`(";
		if(count($columns)>0){
			foreach($columns as $key => $column_info){
				$sql .="`".$column_info['name']."` ".$column_info['type']."(".$column_info['len'].") NOT NULL";
				if($key == "id"){
					$sql .=" AUTO_INCREMENT";
				}
				$sql .=",";
			}
		}
		if(count($primary_key)>0){
			$sql .="PRIMARY KEY (`".$primary_key."`))";
		}
		$sql .="ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		return $this->conn->query($sql);
	}
	
	/**
	 * 向表中添加数据
	 * @param $table 表名
	 * @param $insert_info 插入信息数组
	 * @return boolean true | false
	 */
	public function insertData($table,$insert_info){
		$sql_table_exist = "SELECT COUNT(TABLE_NAME) AS T_COUNT FROM `INFORMATION_SCHEMA`.`TABLES` where `TABLE_SCHEMA`='".$this->db."' and `TABLE_NAME`='".$table."';";
		$result = $this->conn->query($sql_table_exist);
		if($result){
			$row = mysqli_fetch_array($result);
			if($row['T_COUNT']>0){
				if(count($insert_info)>0){
					$sql_insert = "INSERT INTO `".$this->db."`.`".$table."` SET ";
					foreach($insert_info as $key => $value){
						$sql_insert .="`".$key."` = '".$value."',";
					}
					$sql_insert = trim($sql_insert,",");
					$sql_insert .=";";
					return $this->conn->query($sql_insert);
				}
			}
		}
		return false;
	}
	/**
	 * 获取表中的满足条件的记录的总条数
	 * @param string $table 表名
	 * @param Array | string $where 条件
	 * @return Integer $count | boolean  false 查询失败
	 */
	 public function getCount($table,$where){
	 	$sql = "SELECT COUNT(*) AS count FROM `".$this->db."`.`".$table."`";
	 	if($where != "" || !empty($where)){
	 		$where_str = "";
	 		if(is_array($where)){
	 			foreach($where as $key=>$value){
	 				if($where_str!=""){
	 					$where_str .=" AND ";
	 				}
	 				$where_str .=$key ." = '".$value."'";
	 			}
	 		}else{
	 			$where_str = $where;
	 		}
	 		$sql .= " WHERE ".$where_str;
	 	}
	 	if($count_arr = $this->conn->query($sql)){
	 		return $count_arr->num_rows;
	 	}
	 	return false;
	 }
}
?>