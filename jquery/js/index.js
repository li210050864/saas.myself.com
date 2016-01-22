$(document).ready(function(){
  // selector
  //过滤器 :even 一系列元素中的顺序为偶数的元素
  $("#h_tag").find("span:even").each(function(index,elememt){
    //console.log("The value is "+ $(this).find('a').html());
  });
  //过滤器 :odd 一系列元素中的顺序为奇数的元素
  $("#h_tag").find("span:odd").each(function(index,elememt){
    //console.log("The value is "+ $(this).find('a').html());
  });
  //过滤器 :first 一系列元素中的第一个元素
  $("#h_tag").find("span:first").each(function(index,elememt){
    //console.log("The value is "+ $(this).find('a').html());
  });
  //过滤器 :last 一系列元素中的最后一个元素
  $("#h_tag").find("span:first").each(function(index,elememt){
    //console.log("The value is "+ $(this).find('a').html());
  });
  //过滤器:has 元素中包含特定元素的
  var _span = $("#h_tag:has(span)").html();
  //console.log(_span);
  //过滤器:empty 选择为空的元素，元素中没有文字和子标签
  var _class = $("div:empty").attr("class");
  //console.log(_class);
  //过滤器 :contains 包含规定内容的元素
  $("a:contains('文档')").each(function(index,element){
    var _text = $(this).text();
    //console.log(_text);
  });
  //根据元素属性获取元素
  $("a[href='#']").each(function(index,element){
	 //console.log($(this).text());
  });
  //属性值以规定的字符结尾
  $("div[id$=ft]").each(function(){
     //console.log($(this));
  });
  //jQuery 操作css
  $("#menu li>a:first").css("color","#f00");
  $("#menu li>a:last").addClass("w30");
  var _hasClass = $("#f_m_left").hasClass("f_left");
  //console.log(_hasClass);
  $("#f_m_left").removeClass("f_left");
  $("#f_m_left").toggleClass("f_left");
  //event 
//  var imgArray = new Array("images/100.jpg","images/101.jpg","images/102.jpg");
//  var len = imgArray.length;
//  for(var i=0;i<len;i++){
//	  $("<img class='showimg' />").attr({"src":imgArray[i],"id":"img"+i,"width":"90%","style":"margin-bottom:10px"}).load(function(){
//		  $("#img_container").append($(this));
//	  });
//  }
  //错误处理
  $("#laravel_img").error(function(){
	  $(this).attr("src","images/103.jpg");
  });
  //绑定事件
  $("#menu li>a:first").bind({
	  "click":welcome,
	  "dblclick":fn_dbclick,
	  "mouseover":hover,
	  "mouseout":fn_mouseout,
	  "mousemove":fn_mousemove,
  });
  function fn_mousemove(){
	  //console.log("Hello!This is function mouse move!");
  }
  function fn_mouseout(){
	  //console.log("Hello!This is function mouse out!");
  }
  function fn_dbclick(){
	  //console.log("Hello!This is function db_click!");
  }
  function welcome(){
	  //console.log("Welcome in www.laravel.com!");
  }
  function hover(){
	  //console.log("Hello!This is function hover!");
  }
  function fn_mouseenter(){
	  //console.log("Hello!This is function mouse enter!");
  }
  //绑定多个事件 -- 元素的拖拽效果 待完善
  $("#f_m_center .clond_tags>span").bind({
	  "mousedown":fn_mousedown,
	  "mouseup"  :fn_mouseup,
  });
  function fn_mousedown(){
	  $(this).css("border","3px solid #ff3333");
  }
  function fn_mouseup(){
	  $(this).css("border","1px solid #555555");
  }
  //一个事件多个函数
//  $(".content img").hover(fn_mouseenter,fn_mouseout);
  var all_length = 50;
  $("#search").focus(function(){
	  $(this).parent().nextAll("p").show();
  });
  $("#search").blur(function(){
	  $(this).parent().nextAll("p").hide();
  });
  $("#search").keyup(function(){
	  var _val = $(this).val();
	  var sub_len = Number(all_length-parseInt(_val.length));
	  if(sub_len<0){
		  alert("OO!您超过允许的最多（50）字符啦！");
	  }
	  $(this).parent().nextAll("p").find("#number").text(sub_len);
  });
  //简单的动画效果
  $("#menu li").each(function(index,element){
	  $(this).hover(function(){
		  var _ul = $(this).next("ul");
		  if(_ul.length>0){
			  _ul.slideDown();
			  _ul.hover(function(){
				  $(this).slideDown();
			  },function(){
				  $(this).slideUp();
			  });
		  }
	  });
  });
  //$("#show_msg").hide();
  //$("#reshow").hide();
  $("#show_msg span").bind("click",function(){
	  $(this).parents("#show_msg").hide();
	  $("#reshow").show();
  });
  $("#reshow span").bind("click",function(){
	  $(this).parents("#reshow").hide();
	  $("#show_msg").show();
  });
  function hideMsg(){
	  var expireDate = new Date();
	  expireDate.setDate(expireDate.getDate()+30);
	  document.cookie="name=hideCookie;expires="+expireDate.toUTCString();
  }
  if(document.cookie){
	  $("#show_msg").hide();
	  $("#reshow").show();
  }else{
	  $("#show_msg").show();
	  $("#reshow").hide();
	  hideMsg();
	  
  }
  $(".super_condation").hide();
  $("#super_search").click(function(){
	  if($(".super_condation").is(":visible")){
		  $(".super_condation").fadeOut();
	  }else{
		  $(".super_condation").fadeIn();
	  }
  });
  var imgs = new Array();
  $(".content:first").find("img").each(function(index,element){
	  imgs[index] = $(this);
	  $(this).css("z-index",index*100+1);
  });
  $(".no_div").css("z-index",1000);
  $(".no_div").find("span").each(function(index,element){
	  $(this).click(function(){
		  $(this).parent().children("span").removeClass("active");
		  $(this).addClass("active");
		  for(var i = 0;i<imgs.length;i++){
			  if(i != index){
				  if(imgs[i].is(":visible")){
					  imgs[i].fadeOut();
				  }
			  }else{
				  imgs[i].fadeIn();
			  }
		  }
	  });
  });
  //News
  var newsArray = new Array(
	"习近平电贺马尔代夫独立50周年","27省份上半年城乡居民收入出炉 上海最高","野蛮生长仍未破冰 专车合法化的法理困境","高铁动车将不再向乘客发放免费瓶装水","201种科技产品加入免关税清单 覆盖万亿美元贸易额"
  );
  var newLength = newsArray.length;
  var newIntval = 2000;
  $(".news h3").after("<ul id='silde'></ul>");
  $("#silde").css({"margin-top":"10px","font-size":"13px"});
  for(var i = 0; i< newLength;i++){
	  $("#silde").append("<li>"+newsArray[i]+"</li>");
  }
  $("#silde li").css({"line-height":"24px","height":"24px","text-indent":"24px"});
  
  function slideHeadline(){
	  $("#silde li:last").clone().prependTo("#silde").hide();
	  $("#silde li:first").fadeIn(1000).slideDown(500);
	  $("#silde li:last").remove();
  }
  setInterval(slideHeadline,newIntval);
  //Pics
  var picLength = 5;
  var picWidth = 250;
  var descHeight = 150;
  var _picdivWidth = Number(picWidth)*Number(picLength);
  $(".show_pics").css("width",_picdivWidth);
  
  setInterval(_auto,newIntval);
  
  function _auto(){
	  var cur_active = setActive();
	  getSildePos(cur_active);
  }
  function setActive(){
	  var _spanLen = $(".pic_no span").length;
	  var _spanActive = $(".pic_no").find("span.active");
	  var _active = 0;
	  _spanActive.removeClass("active");
	  var _span_no = parseInt(_spanActive.text());
	  if(_span_no == parseInt(_spanLen)){
		  $(".pic_no span").eq(0).addClass("active");
		  _active = 0;
	  }else{
		  _spanActive.next().addClass("active");
		  _active = _span_no;
	  }
	  return _active;
  }
  function getSildePos(_active){
	  var sidePos = _active*picWidth;
	  var _topPos = _active*descHeight;
	  $(".show_pics").animate({
		  "left":-sidePos,
	  },800,function(){
		  $(".e_desc").css("top",-_topPos);
	  });
  }
});