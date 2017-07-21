var Cookie = function(){
	/**
	*	设置cookie：
	*	param:name=cookie名称，一般选用大写
			  value = cookie 的值
			  expire = 过期日期
			  path = 存储位置
			  domaim = 存储域名
	*/
	var setCookie = function(name,value,expire,path,domain){
		document.cookie = name + escape(value) + ((expire) ? "; expires=" + expires.toGMTString() : "") + ((path) ? "; path=" + path : "; path=/") + ((domain) ? ";domain=" + domain : "");
	},
		/**
		 * 获取cookie
		 *param: name = cookie名称
		*/
		getCookie = function(name){
			var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
	        if (arr != null) {
	            return unescape(arr[2]);
	        }
	        return null;
		},
		/**
		 * 删除cookie，将cookie时间设置为过期
		*/
		deleteCookie = function(name,path,domain){
			if (this.get(name)) {
	            document.cookie = name + "=" + ((path) ? "; path=" + path : "; path=/") + ((domain) ? "; domain=" + domain : "") + ";expires=Fri, 02-Jan-1970 00:00:00 GMT";
	        }
		};
	return {set:setCookie,get:getCookie,del:deleteCookie}
}