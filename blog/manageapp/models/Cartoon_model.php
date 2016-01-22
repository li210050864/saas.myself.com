<?php
/**
 * Cartoon_model class
 * 漫画管理
*/
class Cartoon_model extends CI_Model{
	private $tbPrefix;

	private $tablename = "cartoon";

	public function __construct(){
		parent::__construct();
		$this->tbPrefix = $this->db->dbprefix;
	}

	private function set_table($table){
		$this->tablename = $table;
	}

	public function add_group($cartooninfo){
		$this->set_table('cartoonclass');
		return $this->db->insert(
			$this->tbPrefix.$this->tablename,
			$cartooninfo,
			TRUE
			);
	}

	public function get_group($limit,$offset,$orderfield,$ordertype){
		$this->set_table('cartoonclass');
		$sql = "SELECT * FROM ".$this->tbPrefix.$this->tablename." ORDER BY `".$orderfield."` ".$ordertype." LIMIT ".$offset.",".$limit;
		return $this->db->query($sql);
	}

	public function del_group($gid){
		$this->set_table('cartoonclass');
		return $this->db->delete($this->tbPrefix.$this->tablename,"`id` = ".$gid);
	}

	public function get_cartinfo_by_id($gid){
		$this->set_table('cartoonclass');
		return $this->db->select('*')->from($this->tbPrefix.$this->tablename)->where('id',$gid)->get()->row();
	}

	public function edit_group($editInfo,$gid){
		$this->set_table('cartoonclass');
		return $this->db->update($this->tbPrefix.$this->tablename,$editInfo,array('id'=>$gid));
	}

	public function add_cartoon($cartoonInfo){
		$this->set_table('cartoon');
		return $this->db->insert(
			$this->tbPrefix.$this->tablename,
			$cartoonInfo,
			TRUE
		);
	}

	public function get_cartlist_by_gid($gid){
		$this->set_table('cartoon');
		return $this->db->select('*')->from($this->tbPrefix.$this->tablename)->where('cartoon_class ',$gid)->get()->result();
	}

	public function get_cartoon_info_by_id($cid){
		$this->set_table('cartoon');
		return $this->db->select('*')->from($this->tbPrefix.$this->tablename)->where('id',$cid)->get()->row();
	}

	public function edit_cartoon($cartInfo,$cartid){
		$this->set_table('cartoon');
		return $this->db->update($this->tbPrefix.$this->tablename,$cartInfo,array('id'=>$cartid));
	}
}
?>