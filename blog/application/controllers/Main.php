<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->library('wechat');
	}
	/**
	 * Index Page for this controller.
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->view("main");
		redirect("/main/show");
	}

	public function show(){
		$this->load->view("header");
		$this->load->view("index");
		$this->load->view("footer");
	}

	public function editArtGroup(){
		$this->load->view("editArtGroup");
	}

	public function upload(){
		$fileInfo = isset($_FILES['file']) ? $_FILES['file'] : array();
		if($fileInfo && !empty($fileInfo)){
			$this->load->library('lfileup');
			$this->lfileup->setFiletypes('jpg,png,gif,bmp,jpeg'); //设置允许上传的文件类型
			$this->lfileup->setFilesize('2MB'); //设置上传文件的大小限制
			$this->lfileup->setUploaddir(); //设置上传路径
			$result = $this->lfileup->upFile($fileInfo); //上传结果
			echo $result;
		}else{
			return json_encode(array('error_code' => '10008','error_msg' => '缺少参数'));
		}
	}
}