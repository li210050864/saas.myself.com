<?php
/**
 * 
*/
class Admin_model extends CI_Model{

	//private $admin_tb = "admin";
	// private function __clone(){}

	public function __construct(){
		parent::__construct();
	}

	public function check_account($account){
		if($account != ""){
			$sql = "SELECT * FROM `blog_admin` WHERE `account` = '{$account}'";
			$result = $this->db->query($sql);
			if($result->result()){
				if($result->result_id){
					return true;
				}
			}
		}
		return false;
	}

	public function check_login($account,$password){
		if($account != "" && $password != ""){
			$sql = "SELECT * FROM `blog_admin` WHERE `account` = '{$account}' AND `password` = '{$password}'";
			$result = $this->db->query($sql);
			if($result){
				if($result->result_id){
					return true;
				}
			}
		}
		return false;
	}
}
?>