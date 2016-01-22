$(document).ready(function(){
	//登录帐号检查
	$("#loginForm").submit(function(){
		var _account = $("#l-account").val();
		var _pw = $("#l-pw").val();
		if(_account == "" || _account == undefined || _account == null){
			alert("用户名不能为空");
			return false;
		}
		if(_pw == "" || _pw == undefined || _pw == null){
			alert("密码不能为空");
			return false;
		}
		return true;
	});
	//Header 雪花位置
	var _top = Math.random() * 100;
	var _left = Math.random() * 500 + 60;
	$(".snow").css({"top":_top+"px","left":_left+"px"});

	for(var i = 0;i<(Math.random() * 10+8);i++){
		var _snow = "<div class='snow'></div>";
		$("#header").append(_snow);
	}
	$(".snow").each(function(index,element){
		$(this).css({"background":"url(../images/snow_01.png)","position":"absolute"});
		_top =(20 + Math.random()*10*8);  	
		_left =(800 + Math.random()*10*100);
		$(this).css({"top":_top+"px","left":_left+"px"});
	});
	$("#header h3").css({"position":"absolute","z-index":999,"left":"5%"});

	//Menu CSS 切换
	$("#menu").find(".class-a").each(function(index,element){
		$(this).bind("mouseover",function(){
			console.log("come in li bind");
			$(this).parent().find("li.class-a").removeClass("active");
			$(this).parent().find(".submenu").hide();
			$(this).addClass("active");
			$(this).next(".submenu").removeClass("none");
			$(this).next(".submenu").css("margin-left",(index * 100)+"px")
			$(this).next(".submenu").show();
		});
	});

	$(".submenu").find("li").each(function(index,element){
		$(this).bind({
			mouseover:function(){
				$(this).parent("ul").find("li>a").removeClass("active");
				$(this).children('a').addClass("active");
			},
			mouseleave:function(){
				$(this).children('a').removeClass("active");
			}
		});
	});
	$(".submenu").bind("mouseleave",function(){
		$(this).hide();
	});
});