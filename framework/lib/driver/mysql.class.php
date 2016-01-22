<?php
/**
 * class mysql driver 
 * @author lmx
 * @create time 2015-08-24 16:36:00
*/
class Mysql {
  	private $host;
  	private $port;
  	private $dbname;
  	private $username;
  	private $password;
  	private $charset;
  	private $connect;
  	/*
  	 * the mysql class __construct
  	 * set the mysql connect param and perform mysql database connection
  	 * if the connect is error,write the log and show error message
  	*/
  	public function __construct($dbconf=null){
  		$this->host = $dbconf["host"];
  		if($dbconf["port"]!=""){
  			$this->port = $dbconf["port"];
  			$this->host.=":".$this->port;
  		}
  		$this->dbname = $dbconf["database"];
  		$this->username = $dbconf["username"];
  		$this->password = $dbconf["password"];
  		$this->charset = $dbconf["charset"];
  		if(!$this->connect = @mysqli_connect($this->host,$this->username,$this->password,$this->dbname)){
  			$error_message = mysqli_connect_error($this->connect);
  			$error_no = mysqli_connect_errno();
  			$error_str = date("Y-m-d H:i:s")." connect the mysql is error! Error No:".$error_no." Message:".$error_message;
  			create_log("mysql",$error_str);
  			show_message($error_str);
  			return false;
  		}else{
  			return true;	
  		}
  	}
  	/*
  	 * close the mysql connect
  	 * @return boolean true: success false: faild
  	*/
  	public function close(){
  		if(! $result = @mysqli_close($this->connect)){
  			$error_message = mysqli_connect_error($this->connect);
  			$error_no = mysqli_connect_errno();
  			$error_str = date("Y-m-d H:i:s")." connect the mysql is error! Error No:".$error_no." Message:".$error_message;
  			create_log("mysql",$error_str);
  			show_message($error_str);
  		}
  		return true;
  	}
  	/*
  	 * the mysql base query:
  	 * include : simple select,update,delete,insert,set charset, 
  	 * @param $sql string the query sql 
  	 * @return $result the perform resource 
  	*/
  	public function query($sql){
  		if($sql){
  			$result = @mysqli_query($sql);	
  			return $result;
  		}
  		return false;
  	}
  	/*
  	 * query update
  	 * @param $table the table name 
  	 * @param $where the update where
  	 * @param $field the update field
  	 * @return the perform resource
  	*/
  	public function update($table,$where,$field){
  		$where_str = " WHERE 1=1";
  		if(is_array($where)){
  			foreach($where as $key => $value){
  				$where_str .= " AND ".$key." = ".$value;
  			}	
  		}elseif(is_string($where)){
  			$where_str .= $where;	
  		}
  		if(is_array($field)){
  			foreach($field as $fk => $fval){
  				$set_str .= $fk." = ".$fval.","; 	
  			}
  			$set_str = trim($set_str,",");
  		}elseif(is_string($field)){
  			$set_str = $field;	
  		}
  		$sql = "UPDATE {$table} SET {$set_str} WHERE {$where_str}";
  		return $this->query($sql);
  	}
  	/*
  	 * insert record
  	 * @param $table string the insert record table
  	 * @param $fieldarr void string or array the insert field name
  	 * @param $value void string or array the insert record value
  	 * @return this insert result
  	*/
  	public function insert($table,$fieldarr,$value){
  		$sql = "INSERT INTO {$table} (";
  		if(is_array($fieldarr)){
  			foreach($fieldarr as $value){
  				$sql .="{$value},"	
  			}
  		}elseif(is_string($fieldarr)){
  			$sql .=$fieldarr;
  		}
  		$sql .")";
  		$sql .=" VALUES (";
  		if(is_array($value)){
  			foreach($value as $val){
  				$sql .= $val.",";	
  			}	
  		}elseif (is_string($value)) {
  			$sql .=$value;
  		}
  		$sql .=")";
  		return $this->query($sql);
  	}
  	/*
  	 * delete record
  	 * @param $table the name of the table which is will be delete one record
  	 * @param $where the condition of the records
  	 * @return Result of the function delete from table 
  	*/
  	public function delete($table,$where){
  		$sql = "DELETE FROM {$table}";
  		if(!empty($where) && $where!="" && $where){
  			$sql .=" WHERE ";
  			if(is_array($where)){
  				$where_str = "";
  				foreach($where as $key=>$value){
  					if($where_str !=""){
  						$where_str .=" AND ";
  					}
  					$where_str .="{$key} = {$value}";	
  				}	
  				$sql .=$where_str;
  			}elseif(is_string($where)){
  				$sql .=$where;
  			}	
  		}
  		return $this->query($sql);
  	}
  	public function join($tablea,$tableb,$joinon,$where,$order,$limit,$groupby){}
  	/*
  	 * select records
  	 * @param $table get the record from the table 
  	 * @parma $where the condition
  	 * @param $field the show column
  	 * @param $order the records order by column and type
  	 * @param $limit the count 
  	 * @param $group the column group by
  	*/
  	public function select($table,$where,$field,$order,$limit,$group){
  			$sql = "SELECT ";
  			if(is_array($field)){
  				foreach($field as $column){
  					$sql .="{$column},";	
  				}	
  				$sql = trim($sql,",");
  			}elseif(is_string($field)){
  				$sql .=$field;	
  			}
  			$sql .=" FROM {$table} WHERE ";
  			$where_str = "";
  			if(is_array($where)){
  				foreach($where as $key=>$value){
  						if($where_str!=""){
  							$where_str .= " AND ";
  						}
  						$where_str .="{$key} = {$value}";
  				}	
  			}elseif(is_string($where)){
  				$where_str = $where;
  			}
  			$sql .=$where_str;
  			if(!empty($order) && $order!="" && $order){
  				$sql .=" ORDER BY ".$order;	
  			}
  			if(!empty($limit) && $limit!="" && $limit){
  				$sql .=" LIMIT ".$limit;	
  			}
  			if($group && !empty($group) && $group!=""){
  				$sql .=" GROUP BY ".$group;	
  			}
  			return $this->query($sql);
  	}
  	public function count($table,$where){
  		
  	}
  	public function count_join($tablea,$tableb,$joinon,$where,){}
  	public function sum($table,$column,$where){}
 }
?>