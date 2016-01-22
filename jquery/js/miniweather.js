$(document).ready(function(){
	//获取页面元素
	var __$ = function(id) {
		var doc = document;
		return doc.getElementById(id);
	}
	var MiniSite = {
	//加载需要的js文件
		ScriptLoader:{
        Add: function(config) {
            if (!config || !config.src) return;
            var  doc = document;
            var Head = doc.getElementsByTagName('head')[0],         
                Script = doc.createElement('script');
                Script.onload = Script.onreadystatechange = function() {
                    if (Script && Script.readyState && Script.readyState != 'loaded' && Script.readyState != 'complete') return;
                    Script.onload = Script.onreadystatechange = Script.onerror = null;
                    Script.Src = '';
                    if(!doc.all){Script.parentNode.removeChild(Script);}
                    Script = null;
                };
                Script.src = config.src;
                Script.charset = config.charset || 'gb2312';
                Head.insertBefore(Script,Head.firstChild);
            return Script;
        }
    	}
	}
	var Cookie = {
		set:function(name,value){
			var Day = 7;
			var Now = new Date();
			var exp = Now.getTime()+Day*24*60*60;
			document.cookie=name+"="+value+";expires="+exp;  
		},
		get:function(name){
			var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    	if(arr=document.cookie.match(reg))
        return unescape(arr[2]);
    	else
        return null; 
		},
		clear:function(name){
			var Now = new Date();
	    Now.setTime(Now.getTime() - 1);
	    var cval=this.get(name);
	    if(cval!=null)
	        document.cookie= name + "="+cval+";expires="+exp.toGMTString(); 
		}	
	}
	//获取当前城市
	var getCity = {
		//获得省编号
		getProId: function(proName) {
			var ProId;
	    for (var i = 0, len = citys.length; i < len; ++i) {
	    	 proNamearr = citys[i][1].split(" ");
	    	 proNamestr = proNamearr[1];
	        if (proNamestr == proName && parseInt(citys[i][0]) <50) {
	            ProId = citys[i][0];
	        }
	    }
	    return ProId;
		},
		//获得市的编号
		getCityId : function(cityName){
			var cityId;
			for(var i = 0,len = citys.length; i < len;++i){
				cityNamearr = citys[i][2][0][1].split(" ");
				if(cityNamearr[1] == cityName){
					cityArr = citys[i][2][0][2];
					for(var j = 0,clen = cityArr.length; j < clen;++j){
						curCity = cityArr[j];
						curCityNameArr = curCity[1].split(" ");
						curCityName = curCityNameArr[1];
						if(cityName == curCityName){
							cityId = curCity[2];	
						}	
					}
				}
			}	
			return cityId;
		}
	}
  var city_name = remote_ip_info.city;
  var cid = getCity.getCityId(city_name);
	var weather_api = 'http://weather.123.duba.net/static/weather_info/'+cid+'.html';
	MiniSite.ScriptLoader.Add({
      src: weather_api.toString(),
      charset: "utf-8"
  });
  weather_callback = function (Data){ 
  	console.log(Data);
  	var weather = new Object();
  	if (typeof (Data) == "object" && typeof (Data) != "undefined" && typeof (Data.weatherinfo) != "undefined" && Data.weatherinfo != false) {
  		weather.city =  Data.weatherinfo.city;
  		weather.weather = Data.weatherinfo.weather1;
  		weather.temp  = Data.weatherinfo.temp2;
  		console.log(weather);
  		$("#weatherinfo").html(weather.city+" "+weather.weather+" "+weather.temp);
  	}
  }
});
