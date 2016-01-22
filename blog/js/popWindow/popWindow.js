/*
 * js 插件：弹窗
 * 窗口位置居中，相对于屏幕居中
 * 弹窗插件的属性：
 *	大小、颜色、显示的内容
 * * 显示的内容是字符串，提示窗口
 * 弹窗插件的调用方式：
 * var popWin = new popWindow();
 * popWin.alert(str)
 * 兼容浏览器： IE8+，chrome,Firbfox,Sougo
 * 定义类的方式：相当于定义构造函数，所以需要使用new Object() 的方式创建对象
*/
(function(window,jQuery,undefined){

	var HTMLS = {
		winDiv:'<div id="popMask" class="winpop-mask"></div><div id="popWinBox" class="winpop-box"><div id="showContent" class="winpop-main"></div><div id="btnDiv" class="winpop-btns"></div></div>',
		popAlert:'<input type="botton" name="alertInput" value="确定" id="alertSure" class="pop-btn"/>',
		popConfirm:'<input type="button" name="confirmCancel" value="取消" id="canfirmCancel" class="confirm-button"/><input type="button" name="confirmSure" value="确定" id="canfirmSure" class="confirm-button"/>'
	};
	function popWindow(){
		var config = {};
		this.get = function(name){
			return config[name];
		}
		this.set = function(name,value){
			config[name] = value;
		}
		this.init();
	}

	popWindow.prototype = {

		init:function(){
			this.createDom();
			this.bindEvent();
		},

		createDom:function(){
			var _body = jQuery("body");
			var _popwin = jQuery('#popWinBox');
			if(_popwin.length == 0){
				_body.append(HTMLS.winDiv);
			}
			this.set('winDiv',jQuery('#popWinBox'));
			this.set('mask',jQuery('#popMask'));
		},

		bindEvent:function(){
			var _this = this,
				winDiv = this.get('winDiv'),
				popMask = this.get('mask');

			winDiv.on('click','#alertSure',function(){
				_this.hide();
			});

			winDiv.on('click','#canfirmCancel',function(){
				var _callback = _this.get('confirmBack');
				_callback && _callback(false);
			});

			winDiv.on('click','#canfirmSure',function(){
				var _callback = _this.get('confirmBack');
				_callback && _callback(true);
			});
		},

		/*
		 * 设置弹窗样式
		 * styleobj: js 对象，包含弹窗的样式
		 * styleobj{
		 *	alertBtnbg: //确定按钮的背景色
		 *	alertBtncolor: // 确定按钮字体颜色
		 * 	alertBtnborder: // 确定按钮边框颜色
		 *  maskbg: //遮罩层颜色
		 *	windivh: //弹窗高度
		 *	windivw: //弹窗宽度
		 * }
		*/
		setStyle:function(styleobj){
			var _type = this.get('type');
			switch(_type){
				case 'alert':
					if(typeof styleobj == 'undefined'){
						this.get('mask').css('background-color','#000');
						this.get('winDiv').css({'height':'200px','width':'320px'});
						this.get('alertBtn').css({'background-color':'#000','color':'#FFF','border':'1px solid #555'});
					}else{
						this.get('mask').css('background-color',(typeof styleobj.maskbg == 'undefined') ? '#000' : styleobj.maskbg);
						this.get('winDiv').css({'height':(typeof styleobj.windivh == 'undefined') ? '200px' : styleobj.windivh,'width':(typeof styleobj.windivw == 'undefined') ? '320px' : styleobj.windivw});
						this.get('alertBtn').css({'background-color':(typeof styleobj.alertBtnbg == 'undefined') ? '#000' : styleobj.alertBtnbg,'color':(typeof styleobj.alertBtncolor == 'undefined') ? '#FFF' : styleobj.alertBtncolor,'border':(typeof styleobj.alertBtnborder == 'undefined') ? '1px solid #555' : styleobj.alertBtnborder});
					}
				break;
				case 'confirm':
					if(typeof styleobj == 'undefined'){
						this.get('mask').css('background-color','#000');
						this.get('winDiv').css({'height':'200px','width':'320px'});
						this.get('cancelBtn').css({'background-color':'#000','color':'#fff','border':'1px solid #555'});
						this.get('sureBtn').css({'background-color':'#000','color':'#fff','border':'1px solid #555'});
					}else{
						this.get('mask').css('background-color',(typeof styleobj.maskbg == 'undefined') ? '#000' : styleobj.maskbg);
						this.get('winDiv').css({'height':(typeof styleobj.windivh == 'undefined') ? '200px' : styleobj.windivh,'width':(typeof styleobj.windivw == 'undefined') ? '320px' : styleobj.windivw});
						this.get('cancelBtn').css({'background-color':(typeof styleobj.cancelBtnbg == 'undefined') ? '#000' : styleobj.cancelBtnbg,'color':(typeof styleobj.cancelBtncolor == 'undefined') ? '#FFF' : styleobj.cancelBtncolor,'border':(typeof setStyle.cancelBtnborder == 'undefined') ? '1px solid #555' : setStyle.cancelBtnborder});
						this.get('sureBtn').css({'background-color':(typeof styleobj.sureBtnbg == 'undefined') ? '#000' : styleobj.sureBtnbg,'color':(typeof styleobj.sureBtncolor == 'undefined') ? '#FFF' : styleobj.sureBtncolor,'border':(typeof styleobj.sureBtnborder == 'undefined') ? '1px solid #555' : styleobj.sureBtnborder});
					}
				break;
				default:
				break;
			}
		},

		alert:function(str,btnstr,styleobj){
			var _this = this;
			var str = typeof str === "string" ? str : str.toString(),
				winDiv = this.get('winDiv');
			this.set('type','alert');
			winDiv.find('#showContent').html(str);
			if(typeof btnstr == "undefined"){
				winDiv.find('#btnDiv').html(HTMLS.popAlert);
			}else{
				winDiv.find('#btnDiv').html(btnstr);
			}
			_this.set('alertBtn',jQuery('#alertSure'));
			_this.setStyle(styleobj);
			_this.show();
		},

		confirm:function(str,callback,styleobj){
			var str = typeof str === "string" ? str : str.toString(),
				winDiv = this.get('winDiv');
			this.set('type','confirm');
			winDiv.find("#showContent").html(str);
			winDiv.find('#btnDiv').html(HTMLS.popConfirm);
			this.set('confirmBack',(callback || function(){}));
			this.set('cancelBtn',jQuery('#canfirmCancel'));
			this.set('sureBtn',jQuery('#canfirmSure'));
			this.setStyle(styleobj);
			this.show();
		},

		show:function(){
			this.get('winDiv').show();
			this.get('mask').show();
		},

		hide:function(){
			var winDiv = this.get('winDiv');
			winDiv.find('#showContent').html("");
			winDiv.find('#btnDiv').html("");
			winDiv.hide();
			this.get('mask').hide();
		},

		destory:function(){
			this.get('winDiv').remove();
			this.get('mask').remove();
			delete window.alert;
			delete window.confirm;
		}
	};
	window['popWindow'] = popWindow;
	// var obj = new popWindow();
	// window.alert = function(str){
	// 	obj.alert.call(obj,str);
	// }
	// window.confirm = function(str,cb){
	// 	obj.confirm.call(obj,str,cb);
	// }
})(window,jQuery);