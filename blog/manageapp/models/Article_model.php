<?php
/**
 * Article_model class
 * 文章管理
*/
class Article_model extends CI_Model{
	private $tbPrefix;

	public function __construct(){
		parent::__construct();
		$this->tbPrefix = $this->db->dbprefix;
	}

	private function set_tablename(){}

	public function get_group(){
		$sql = "SELECT * FROM `{$this->tbPrefix}artclass` ORDER BY `id` DESC";
		$result = $this->db->query($sql);
		return $result;
	}


}
?>