<?php
/*
 * Cartoon.php
 * 漫画处理类
*/
class Cartoon extends BLOG_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('cartoon_model');
	}

	public function philosophy(){
		$data['page'] = "CAR_INDEX";
		$data['subpage'] = "philosophy";
		$this->load->view("header",$data);
		$cartoonData['rows'] = null;
		$result = $this->cartoon_model->get_group($limit=20,$offset=0,$orderfield='id',$ordertype='asc');
		if($result){
			$cartoonData['rows'] = $result;
		}
		$this->load->view("cartoonlist",$cartoonData);
		$this->load->view("footer");
	}
	/*
	 * add cartoon group
	*/
	public function add(){
		$data['page'] = "CAR_INDEX";
		$data['subpage'] = "philosophy";
		$this->load->view('header',$data);
		if($this->input->post()){
			$cartoongroupInfo = $this->input->post('cartclass',TRUE);
			if($cartoongroupInfo && count($cartoongroupInfo)>0){
				$cartoongroupInfo['createtime'] = date("Y-m-d H:i:s",time());
				if($this->cartoon_model->add_group($cartoongroupInfo)){
					$this->alertInfo($this->lang->line('ADD_CART_CLASS_OK'),site_url('/cartoon/philosophy'));
				}else{
					$this->alertInfo($this->lang->line('ADD_CART_CLASS_FAILD'),site_url('/cartoon/add'));
				}
			}
		}
		$this->load->view('addcartgroup');
		$this->load->view('footer');
	}

	/*
	 * del cartoon group
	*/
	public function del(){
		$data['page'] = "CAR_INDEX";
		$data['subpage'] = "philosophy";
		$gid = $this->uri->segment(3);
		if(isset($gid) && !empty($gid)){
			if($this->cartoon_model->del_group($gid)){
				$this->alertInfo($this->lang->line('DEL_CART_CLASS_OK'),site_url('/cartoon/philosophy'));
				exit();
			}
		}
		$this->alertInfo($this->lang->line('DEL_CART_CLASS_FAILD'),site_url('/cartoon/philosophy'));
	}

	/*
	 * edit cartoon group
	*/
	public function edit(){
		$gid = $this->uri->segment(3);
		if(isset($gid) && !empty($gid)){
			$data['page'] = "CAR_INDEX";
			$data['subpage'] = "philosophy";
			$this->load->view('header',$data);
			$cartoonData = null;
			$cartoonData['cartoonData'] = $this->cartoon_model->get_cartinfo_by_id($gid);
			$this->load->view('editcartgroup',$cartoonData);
			$this->load->view('footer');
			//edit the group info
			if($this->input->post()){
				$cartoongroupInfo = $this->input->post('cartclass',TRUE);
				if($cartoongroupInfo && count($cartoongroupInfo)>0){
					$cartoongroupInfo['updatetime'] = date("Y-m-d H:i:s",time());
					if($this->cartoon_model->edit_group($cartoongroupInfo,$gid)){
						$this->alertInfo($this->lang->line('EDIT_CART_CLASS_OK'),site_url('/cartoon/philosophy'));
					}else{
						$this->alertInfo($this->lang->line('EDIT_CART_CLASS_FAILD'),site_url('/cartoon/edit/'.$gid));
					}
				}
			}
		}else{
			$this->alertInfo($this->lang->line('CART_CLASS_ID_PARAM_ERROR'),site_url('/cartoon/philosophy'));
		}	
	}

	public function addCart(){
		$data['page'] = "CAR_INDEX";
		$data['subpage'] = "philosophy";
		$this->load->view('header',$data);
		if($this->input->post()){
			$cartoonInfo = $this->input->post('cartoon',TRUE);
			$cartoonInfo['createtime'] = date("Y-m-d H:i:s",time());
			if($cartoonInfo && count($cartoonInfo)>0){
				if(!isset($cartoonInfo['cartoonImgs'])){
					$this->cartoon_model->add_cartoon($cartoonInfo);
				}else{
					$cartoonImgs = $cartoonInfo['cartoonImgs'];
					unset($cartoonInfo['cartoonImgs']);
					$this->cartoon_model->add_cartoon($cartoonInfo);
				}
				
			}
		}else{
			$cartoonData['rows'] = $this->cartoon_model->get_group($limit=20,$offset=0,$orderfield='id',$ordertype='asc');
			$this->load->view("addcart",$cartoonData);
		}	
		$this->load->view('footer');
	}

	/*
	 * cartoon list by group id
	*/
	public function cartlist(){
		$data['page'] = 'CAR_INDEX';
		$data['subpage'] = "philosophy";
		$this->load->view('header',$data);
		$gid = $this->uri->segment(3);
		$cartlistData['rows'] = null;
		if($gid){
			$cartlistData['rows'] = $this->cartoon_model->get_cartlist_by_gid($gid);
		}
		$this->load->view('cartlist',$cartlistData);
		$this->load->view('footer');
	}

	public function editCart(){
		$data['page'] = 'CAR_INDEX';
		$data['subpage'] = "philosophy";
		$this->load->view('header',$data);
		if(!empty($cartid = $this->uri->segment(3)) && !empty($gid = $this->uri->segment(4))){
			if($this->input->post()){
				$cartoonInfo = $this->input->post('cartoon');
				if(isset($cartoonInfo['cartoonImgs']) && !enpty($cartoonInfo['cartoonImgs'])){
					$cartoonImgs = $cartoonInfo['cartoonImgs'];
					unset($cartoonInfo['cartoonImgs']);
					$this->cartoon_model->edit_cartoon($cartoonInfo,$cartid);
				}else{
					$this->cartoon_model->edit_cartoon($cartoonInfo,$cartid);
				}
				redirect('cartoon/cartlist/'.$gid);
				exit(1);
			}
			$cartInfo['cartInfo'] = null;
			$cartInfo['rows'] = $this->cartoon_model->get_group($limit=20,$offset=0,$orderfield='id',$ordertype='asc');
			$cartInfo['cartInfo'] = $this->cartoon_model->get_cartoon_info_by_id($cartid);
			$this->load->view('cartedit',$cartInfo);
		}
		$this->load->view('footer');
	}
}
?>