<?php
/**
 * Article_Controller 
 * 文章管理
 * @author lmx
 * @create time 2015-11-20
*/
class Article extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	/*
	 * 文章分类列表
	*/
	public function index(){
		$data['page'] = "ART_INDEX";
		$data['subpage'] = "class";
		$this->load->view("header",$data);

		$this->load->model("article_model");
		$gRows = $this->article_model->get_group();
		$classData['rows'] = $gRows;
		$this->load->view("main",$classData);
		$this->load->view("footer");
	}
	/*
	 * 添加文章
	*/
	public function addArticle(){
		$data['page'] = "ART_INDEX";
		$data['subpage'] = "class";
		$this->load->view('header',$data);
		$artData = null;
		$this->load->view('addarticle',$artData);
		$this->load->view('footer');
	}
}
?>