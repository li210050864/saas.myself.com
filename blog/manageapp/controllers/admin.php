<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	/**
	 * the class's construct function 
	*/
	public function __construct(){
		parent::__construct();
	}

	/**
	 * Index Page for this controller.
	 * So any other public methods not prefixed with an underscore will
	 * map to /admin.php/admin/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->view("admin");
	}
	/**
	 * Login controller function
	*/
	public function login(){

		$account =  ($this->input->post('account')) ? html_escape($this->input->post('account')) : "";
		$password = ($this->input->post('pw')) ? html_escape($this->input->post('pw')) : "";

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('admin_model');

		$this->form_validation->set_rules('account', 'Account',array(array("AccountErr",array($this->admin_model,"check_account"))));
		$this->form_validation->set_message("AccountErr","The Account is Error");
        $this->form_validation->set_rules('pw', '密码', 'required');

		if ($this->form_validation->run() == FALSE){
			$this->load->view("admin");
        }else{
    		if($this->admin_model->check_login($account,$password)){
    			redirect('/article/index');
    			exit();
    		}
        	redirect('/admin/index');
        }
	}

}