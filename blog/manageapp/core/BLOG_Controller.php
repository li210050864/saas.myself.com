<?php
/*
 * base controller
*/
class BLOG_Controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->get_language();
	}

	/*
	 * 加载语言包
	*/
	private function get_language(){
		$lan = $this->config->item('language');
		$this->lang->load('common',$lan);
	}

	/*
	 * 提示信息并跳转页面
	*/
	protected function alertInfo($str,$url){
		echo "<script>alert('".$str."');window.location.href='".$url."'</script>";
	}
}
?>