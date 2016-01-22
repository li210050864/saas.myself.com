<?php
/*
 * Created on 2015��7��15��
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
	 * ����mysql��������������IP
	 * @param $host mysql��������������IP Ĭ��localhost
	 */
	public function setHost($host = "localhost"){
		$this->host = $host;
	}
	/**
	 * ����mysql�������������û���
	 * @param $username �û��� Ĭ��Ϊ root
	 */
	public function setUsername($username = "root"){
		$this->username = $username;
	}
	/**
	 * ����mysql��������������
	 * @param $password ���� Ĭ��Ϊ��
	 */
	public function setPassword($password = ""){
		$this->password = $password;
	}
	/**
	 * ����mysql�������ı���
	 * @param $charser ���ݿ���� Ĭ�� utf8
	 */
	public function setCharset($charset = "utf8"){
		$this->charset = $charset;
	}
	/**
	 * �������ݿ�
	 * @param $db ���ݿ�����
	 */
	public function setDb($db = ""){
		$this->db = $db;
	}
	/**
	 * ���캯����������ݿ������
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
	 * ������
	 * @param string $table ����
	 * @param Array $columns ����Ϣ�����ƣ����ͣ����ȡ�
	 * @param string $primary_key ����������
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
	 * ������������
	 * @param $table ����
	 * @param $insert_info ������Ϣ����
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
	 * ��ȡ���е����������ļ�¼��������
	 * @param string $table ����
	 * @param Array | string $where ����
	 * @return Integer $count | boolean  false ��ѯʧ��
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