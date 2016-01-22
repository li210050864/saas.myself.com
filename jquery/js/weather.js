var __$ = function (id) { var doc = document; return doc.getElementById(id) }
var W = document.getElementById('weatherinfo');
var Weather = {
    timer : null,
    CityCookieName: 'citydata',
    WeatherCookieName: 'weather',
    DefaultCity: ['109', '101010100', '101010100', '北京', '北京'],
    StatIPQueue: [],
    StatGetQueue: [],
    Set: function () {
        __$("setCityBox").style.display = "";
        var City = Cookie.get(this.CityCookieName);
        if (City) {
            City = City.split(",");
        } else {
            City = this.DefaultCity;
        }
        __$("w_pro").value = City[0];
        this.initCitys(City[0]);
        __$("w_city").value = City[1];
        this.initAreaCitys(City[2]);
    },
    ShowStatus: function (num) {
        if (!num) { return }
        var TPL = '<ul class="weather"><li><h4 class="city">#{city}</h4></li><li class="tWrap"><div class="i"><a href="http://www.duba.com/tianqiyubao.html?cityid=#{cityid}"><img  onload="pngfix(this)" title="#{img1_title}" src="static/images/weather/#{img1}.png" /></a></div><a href="http://www.duba.com/tianqiyubao.html?cityid=#{cityid}" target="_blank" class="t" title="#{jtitle}">今&nbsp;#{img1_title}<i class="tem">#{today}</i><i class="tem2">#{pollution}</i></a></li><li class="mWrap"><div class="i"><a href="http://www.duba.com/tianqiyubao.html?cityid=#{cityid}"><img onload="pngfix(this)" title="#{img2_title}" src="static/images/weather/#{img2}.png" /></a></div><a href="http://www.duba.com/tianqiyubao.html?cityid=#{cityid}" target="_blank" class="t" title="#{mtitle}">明&nbsp;#{img2_title}<i class="tem">#{tomorrow}</i></a></li></ul>';
        var str;
        //$(".weather-tip").hide();
        switch (num) {
            case 100:
            	str = '正在判断城市，请稍后...&nbsp;  <a href="http://www.duba.com/tianqiyubao.html" target="_blank">快速查看</a>';
                break;
            case 101:
                str = '判断城市失败，默认为北京，请手动设置。';
                break;
            case 102:
                str = '正在获取天气数据，请稍候... <a href="http://www.duba.com/tianqiyubao.html" target="_blank">快速查看</a>';
                break;
            case 404:
            	str = '很抱歉，暂无该城市天气数据。';
                break;
            case 500:
                str = '服务器错误或本地网络过慢。<a href="javascript:void(0);" target="_self" onclick="Weather.Init();return false;">[点击重试]</a>';
                break;
            case 200:
                var result = arguments[1];
                var weekStr = ['日', '一', '二', '三', '四', '五', '六'],
                    nowD = new Date();
                var w1 = nowD.getDay();
                var w2 = nowD.getDay() == 6 ? 0 : w1 + 1;
                str = format(TPL, {
                    cityid: result[3],
                    city: result[0],
                    today: result[1],
                    tomorrow: result[2],
                    img1: result[4],
                    img2: result[5],
                    week1: weekStr[w1],
                    week2: weekStr[w2],
                    img1_title:result[6],
                    img2_title:result[7],
                    pollution : result[8],
                    jtitle : result[9],
                    mtitle : result[10]
                });
                break;
        }
        W.innerHTML = str;
    },
    Ip2City: function (callback) {
        this.ShowStatus(100);
        Timeon.ScriptLoader.Add({
        src:'http://www.duba.com/static/v2/iframe/js/city.js', //duba
        charset:'gb2312'
        });
        var that = this;
        
//        if (typeof Ip2CityTimeOut != "undefined") {
//            window.clearTimeout(Ip2CityTimeOut);
//        }
//        var Ip2CityTimeOut = window.setTimeout(function () {
//            Cookie.clear(this.CityCookieName);
//            callback && callback(that.DefaultCity);
//        }, 3000);
        
        window.ILData_callback = function () {
            if (typeof (ILData) != "undefined") {
//                if (typeof Ip2CityTimeOut != "undefined") {
//                    window.clearTimeout(Ip2CityTimeOut);
//                }
                if (ILData[2] && ILData[3]) {
                    var pid = Timeon.getProId(ILData[2]);
                    var cid = Timeon.getCityId(pid, ILData[3]);
                    var City = [pid, cid, cid, ILData[2], ILData[3]];
                    Cookie.set(that.CityCookieName, City);
                    callback && callback(City);
                }
                else{
                    that.ShowStatus(101);
                    Cookie.set(that.CityCookieName, that.DefaultCity);
                    callback && callback(that.DefaultCity);
                }
            }
        }
    },
    Get: function (cityid) {
        if (!cityid) return;
        var AleaId = cityid.slice(3, 7);
        var showStatus = this.ShowStatus;
        var that = this;
        showStatus(102);
        if (typeof TimeOut != "undefined") {
            window.clearTimeout(TimeOut);
        }
        if(!Cookie.get(this.CityCookieName)){
            var TimeOut = window.setTimeout(function () {
                showStatus(500);
                Cookie.clear(this.CityCookieName);
            }, 5000);
        }
        var api = 'http://weather.123.duba.net/static/weather_info/'+cityid+'.html';
        if (!Cookie.get(this.WeatherCookieName)) {
            
        }
        Timeon.ScriptLoader.Add({
            src: api.toString(),
            charset: "utf-8"
        });
        weather_callback = function (Data){ //毒霸 api 返回形式
           // window.clearTimeout(Weather.timer);
            var _weather = $("#weather").el;
            if (typeof (Data) == "object" && typeof (Data) != "undefined" && typeof (Data.weatherinfo) != "undefined" && Data.weatherinfo != false) {
                var Desc = [Data.weatherinfo['temp1'], Data.weatherinfo['temp2']];
                var result = [Data.weatherinfo.city, Desc[0], Desc[1], cityid,Data.weatherinfo['img1'], Data.weatherinfo['img3'],Data.weatherinfo['weather1'],Data.weatherinfo['weather2'],Data.weatherinfo["pollution"],Data.weatherinfo["jtitle"],Data.weatherinfo["mtitle"]];
                var _weatherTip = $(".weather-tip");
                if (result) {
                    Weather.ShowStatus(200, result);
                    $(".tWrap",_weather).hover(function(el){
                        $(el).addClass("tWrapHover");
                    },function(el){
                        $(el).removeClass("tWrapHover");
                    });
                    $(".mWrap",_weather).hover(function(el){
                        $(el).addClass("mWrapHover");
                    },function(el){
                        $(el).removeClass("mWrapHover");
                    });
                    if(Data.weatherinfo["pollution"] && Data.weatherinfo["pollution"] != ""){
                        $(".tWrap .tem",_weather).hide();
                    }
                    Weather.timer = window.setTimeout(function(){
                        $(".tem2",_weather).hide();
                        $(".tWrap .tem",_weather).show();
                    },10000);
                    var rainImgs = ["3","4","5","6","7","8","9","10","11","12","19","21","22","23","24","25"];
                    var snowImgs = ["13","14","15","16","17","26","27","28"];
                    var muaiImgs = ["53"];
                    if(snowImgs.indexOf(Data.weatherinfo['img1'])!= -1){
                        _weatherTip.el.childNodes[0].nodeValue = "今天有雪，小心路滑";
                    }
                    if(muaiImgs.indexOf(Data.weatherinfo['img1'])!= -1){
                        _weatherTip.el.childNodes[0].nodeValue = "雾霾天气，注意防护";
                    }
                    if(rainImgs.concat(snowImgs).concat(muaiImgs).indexOf(Data.weatherinfo['img1'])!= -1){
                        _weatherTip.show();
                        $(".weather-close",_weatherTip.el).on("click",function(){
                            _weatherTip.hide();
                        });
                        window.setTimeout(function(){
                            _weatherTip.hide();
                        },10000);
                    }   
                    Cookie.set(that.WeatherCookieName, 1);
                }
            } else if (Data.weatherinfo == false) {
                Weather.ShowStatus(404);
            }
        }
    },
    Init: function () {
        var ckname = this.CityCookieName;//citydata
        var that = this;
        if (Cookie.get(this.CityCookieName)) {
            var City = Cookie.get(this.CityCookieName).split(',');
            if (!City[2]) {
                Cookie.clear(this.CityCookieName);
                that.Init();
            }
            this.Get(City[2]);
        } else {
            this.Ip2City(function (City) {
                var C = Cookie.get(that.CityCookieName);
                if (C) {
                    C = C.split(',')
                    that.Get(C[2]);
                } else {
                    that.Get(City[2]);
                }
            });
        }
    },
    getAreas:function(cid){
    	 var AreaId = cid.slice(3, 7);
    	 console.log(typeof __$("city_set_ifr"));
    	 console.log(__$("city_set_ifr"));
         if ( __$("city_set_ifr") == null) {
             var dbDns = "http://www.duba.com";
             __$("setCityBox").innerHTML = '<iframe scrolling="no" frameborder="0" allowtransparency="true" id="city_set_ifr" src="'+dbDns+'/static/v2/iframe/city_set_new.html" style="width: 350px;margin:0 auto;"></iframe>';
         }
         __$("setCityBox").style.display = "block";
         __$("weather").style.display = "none";
    },
    initCitys: function (pid) {
        if (!pid) return;
        __$("w_city").innerHTML = "";
        for (var i = 0, len = CityArr.length; i < len; ++i) {
            var I = CityArr[i];
            if (I[1] == pid) {
                var option = document.createElement("option");
                option.value = I[2];
                option.innerHTML = I[3] + '&nbsp;' + I[0];
                __$("w_city").appendChild(option);
            }
        }
        __$("w_city").selectedIndex = 0;
    },
    initAreaCitys: function (cid, callback) {
        __$("l_city").innerHTML = "";
        this.getAreas(cid);
    },
    cp: function (val) {
        this.initCitys(val);
        __$("w_city").selectedIndex = 0;
        this.cc(__$("w_city").value);
    },
    cc: function (val) {
        this.initAreaCitys(val, function () { });
    },
    custom: function () {
        var City = Cookie.get(this.CityCookieName);
        if (City) {
            City = City.split(",")
        } else {
            City = this.DefaultCity;
        }
        var C = [__$("w_pro").value,
              __$("w_city").value,
              __$("l_city").value ? __$("l_city").value : __$("w_city").value,
              Timeon.getSelectValue(__$("w_pro")),
              Timeon.getSelectValue(__$("w_city"))
        ];
        if (City[2] != C[2]) {
            this.Get(C[2]);
            Cookie.set(this.CityCookieName, C);
        }
        __$("setCityBox").style.display = "none";
        W.style.display = "";

    },
    autoLoad: function () {
        Cookie.clear(this.CityCookieName);
        Cookie.clear(this.WeatherCookieName);
        //window.location.reload();
        this.Init();
        __$("setCityBox").style.display = "none";
        W.style.display = "";
    }
}
Weather.Init();