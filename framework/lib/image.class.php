<?php
/**
 * image class file
 * @author lmx
 * @create time 2015-08-25 13:58:00
 * Basic image processing for complete picture retracted, add watermark
 * When the watermark exceeds the target image size, the watermark can automatically adapt to the target image and narrow
 * Consolidation of the watermark can be set with the background
 *
 * Instructions:
 *
*/
class Image{
	//the img file name
	private $img_file;
	//the img resource src
	private $img_src;
	//the img handle
	private $img_handle;
	//the water mask handle
	private $water_handle;
	//the img create quality
	private $img_create_quality;
	//the img display quality
	private $img_display_quality;
	//the img scaling
	private $img_scale;
	//original width
	private $width;
	//original height
	private $height;
	//new img width
	private $n_width;
	//new img height
	private $n_height;
	//fill width
	private $f_width;
	//fill height
	private $f_height;
	//copy width
	private $copy_width;
	//copy height
	private $copy_height;
	//Picture rendering start abscissa
	private $src_x;
	//Picture rendering start ordinate
	private $src_y;
	//The new start drawing the abscissa
	private $start_x;
	//The new start drawing the ordinate
	private $start_y;
	//Watermark Text
	private $mask_word;
	// watermark img
	private $mask_img;
	//Watermark abscissa
	private $mask_pos_x;
	//Watermark ordinate
	private $mask_pos_y;
	// watermark offset x
	private $mask_offset_x;
	// watermark offset y
	private $mask_offset_y;
	// watermark font width
	private $font_w;
	// watermark font height
	private $font_h;
	// watermark width
	private $mask_w;
	// watermark height
	private $mask_h;
	// watermark font color
	private $mask_font_color;
	// watermark font
	private $mask_font;
	// watermark font size
	private $font_size;
	// mark poisition
	private $mask_position;
	//Photos merger degree, the greater the value, the lower the merger process
	private $mask_img_pct;
	//Text degree of consolidation, the smaller the value, the lower the merger process
	private $mask_txt_pct;
	// img border size
	private $img_border_size;
	// img border color
	private $img_border_color;
	// Flip Horizontal frequency
	private $flip_x;
	// Flip Vertical frequency
	private $flip_y;
	//cut type
	private $cut_type;
	// image type
	private $img_type;
	private $all_type = array(
		'jpg' => array("output"=>"imagejpeg"),
		'jpeg' => array("output"=>"imagejpeg"),
		'gif' => array("output"=>"imagegif"),
		'png' => array("output"=>"imagepng"),
		'wbmp' => array("output"=>"image2wbmp"),
	);
	
	public function __construct(){
	}
	
	public function getImgWidth($src){
		return imagesx();	
	}
	public function getImgHeight($src){
		return imagesy($src);	
	}
	public function setSrcImg($src_img,$img_type=null){
		if(!file_exists($src_img)){
			$error_log = date("Y-m-d H:i:s")." The img is not exists!";
			create_log("image",$error_log);
			show_message("The image is not exists!");	
		}
		if(!empty($img_type)){
			$this->img_type = $img_type;	
		}else{
			$this->img_type = $this->getImgType($src_img);	
		}
		$this->checkValid($this->img_type);
		$src = "";
		if(function_exists("file_get_contents")){
			$src = file_get_contents($src_img);
		}else{
			$handle = fopen($src_img,"r");
			while(!feof($handle)){
				$src .= fgets($handle,4096);	
			}	
			fclose($handle);
		}
		if(empty($src)){
			$error_log = date("Y-m-d H:i:s")."The image src is empty!";
			create_log("image",$error_log);
			show_message("The image src is empty!");	
		}
		$this->img_src = @ImageCreateFromString($src);
		$this->width = $this->getImgWidth($this->img_src);
		$this->height = $this->getImgHeight($this->img_src);
	}
	public function setNewImg($new_img){
		$arr = explode(DIRECTORY_SEPARATOR,$new_img);
		$last = array_pop($arr);
		$path = implode(DIRECTORY_SEPARATOR,$arr);
		$this->mkdir($path);
		$this->img_file = $new_img;	
	}
	public function setImgDisplayQuality($n){
		$this->img_display_quality = parseInt($n);
	}
	public function setImgCreateQuality($n){
		$this->img_create_quality = parseInt($n);	
	}
	public function setMaskWord($word){
		$this->mask_word = $word;	
	}
	public function setMaskFontSize($size){
		$this->font_size = $size;	
	}
	public function serMaskFont($font){
		$this->mask_font = $font;
	}
	public function setMaskImg($img){
		$this->mask_img = $img;	
	}
	public function setMaskOffsetX($x){
		$this->mask_offset_x = parseInt($x);	
	}
	public function setMaskOffsetY($y){
		$this->mask_offset_y = $y;	
	}
	public function setMaskPosition($position){
		$this->mask_position = parseInt($position);	
	}
	public function setMaskImgPct($n){
		$this->mask_img_pct = parseInt($n);
	}
	public function setMaskTxtPct($n){
		$this->mask_txt_pct = parseInt($n);	
	}
	public function setDstImgBorder($size,$color,){
		$this->img_border_size = parseInt($size);	
		$this->img_border_color = parseInt($color);
	}
	public function flipH(){
		$this->flip_x++;	
	}
	public function flipV(){
		$this->flip_y++;	
	}
	public function setCutType($type){
		$this->cut_type = parseInt($type);	
	}
	public function serRectangleCut($width,$height){
		$this->f_width = $width;
		$this->f_height = $height;	
	}
	public function serSrcCutPosition($x,$y){
		$this->src_x = $x;
		$this->src_y = $y;	
	}
	public function createImg($a,$b=null){
		$num = func_num_args();
		if(1 == $num){
			$r = parseInt($a);
			if($r < 1){
				$error_log = date("Y-m-d H:i:s")."Image scale of not less than 1";
				create_log("image",$error_log);
				show_message("Image scale of not less than 1");	
			}
			$this->img_scale = $r;
			$this->setNewImgSize($r);
		}
	}
}
?>