(function(){
	var _Banner = {},
		switchBInterval,
		switchTime = 3000,
		showOneInter,
		showTime = 50,
		curBanner = 1,
		titleH = 30;

	_Banner.length = 0;
	_Banner.ele = $(".banner-ul li");
	_Banner.titles = $(".banner .title p");
	_Banner.dots = $(".banner .dot span");
	_Banner.length = _Banner.ele.length;

	$.fn.eachImgShow = function(){
		this.css({"opacity":1,"display":"block","z-index":1});
	}
	$.fn.eachImgHide = function(){
		this.css({"opacity":0,"display":"none","z-index":0});
	}
	$.fn.showEachBanner = function(opacity){
		this.css({"opacity":opacity,"display":"block","z-index":1});
		if(parseInt(opacity) == 1){
			clearInterval(showOneInter);
			curBanner++;
		}
	}
	$.fn.switchDot = function(){
		this.closest(".dot").find("span").removeClass("curdot");
		this.addClass("curdot");
	}
	$.fn.switchTitle = function(top){
		this.animate({"margin-top":top+"px"},"normal","linear");
	}
	$.fn.initTitle = function(index){
		this.css("margin-top","0px");
	}
	//显示首张banner
	var firstImg = $(_Banner.ele[0]);
	firstImg.eachImgShow();
	//自动轮循
	function switchBanner(){
		for(var eindex  = 0;eindex < _Banner.length;eindex++){
			$(_Banner.ele[eindex]).eachImgHide();
		}
		// show banner img
		var tmpOpacity = 0;
		showOneInter = setInterval(function(){
			tmpOpacity = (tmpOpacity * 10)+ 1;
			tmpOpacity = tmpOpacity / 10;
			$(_Banner.ele[curBanner]).showEachBanner(tmpOpacity);
		},showTime);
		// switch dot
		$(_Banner.dots[curBanner]).switchDot();
		//switch title
		var curTitle = curBanner - 1,
			top = -(titleH);
		if(curTitle == -1){
			curTitle = 0;
			top = 0;
			for(var i = 0; i < _Banner.length ;i++){
				$(_Banner.titles[i]).initTitle(i);
			}
		}
		$(_Banner.titles[curTitle]).switchTitle(top);
	}

	function init(){
		switchBInterval = setInterval(function(){
			if(curBanner == _Banner.length){
				curBanner = 0;
			}
			switchBanner();
		},switchTime);
	}
	init();

	//点击dot切换
	$(_Banner.dots).each(function(index,element){
		$(element).click(function(){
			curBanner = index;
			clearInterval(switchBInterval);
			switchBanner();
			init();
		});
	});
})();