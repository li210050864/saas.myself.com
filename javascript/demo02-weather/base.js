function getElementsByClassName(node,classname){
    if(node.getElementsByClassName){
        return node.getElementsByClassName(classname);
    }else{
        var results = new Array();
        var eles = node.getElementsByTagName("*");
        for(var i = 0;i< eles.length;i++){
            if(eles[i].className.indexOf(classname) != -1){
                results[results.length] = eles[i];
            }
        }
        return results;
    }
}
function daysObj(){
    var todayObj = new Date(),
        yesterdayObj = new Date(),
        weekdays = [];
    year = function(dateObj){
        return dateObj.getFullYear();
    },
    month = function(dateObj){
        return dateObj.getMonth() + 1;
    },
    date = function(dateObj){
        return dateObj.getDate();
    },
    week = function(dateObj){
        var weekstr = "星期",
            weekday = dateObj.getDay(),
            weekval = ["日","一","二","三","四","五","六"];
       if(weekday && typeof weekday == "Number"){
           weekstr += weekval[weekday];
       }
    },
    getToday = function(){
        return month(todayObj) + "月" + date(todayObj) + "日";
    },
    getYeaterday = function(){
        yesterdayObj.setTime(todayObj.getTime() - 3600 * 24 * 1000);
        return month(yesterdayObj) + "月" + date(yesterdayObj) + "日";
    },
    getWeekdays = function(){
        var dateStr ="";
        for(var i = 6; i >= 0; i--){
            dateStr = "";
            var tmpdateObj = new Date();
                tmpdateObj.setTime(todayObj.getTime() - 3600 * 24 * 1000 * i);
            dateStr = month(tmpdateObj) + "月" + date(tmpdateObj) + "日";
            weekdays.push(dateStr);
        }
        dateStr = getYeaterday();
        weekdays.push(dateStr);
        return weekdays;
    };
    /**
     * 获取指定月份的天数
     * @param year 表示年份的四位数字
     * @param month 表示月份的整数 介于 0 ~ 11
     * tip： UTC 方法可根据世界时返回 1970 年 1 月 1 日 到指定日期的毫秒数
     *       getUTCDate： 方法可根据世界时返回一个月 (UTC) 中的某一天。
     * @returns {number}
     */
    function daysInMonth(year,month){
        return new Date(Date.UTC(year,month+1,0)).getUTCDate();
    }
    function getDaysInMonth(){
        return daysInMonth(year(todayObj),month(todayObj));
    }
    return {getDaysInMonth:getDaysInMonth,getWeekdays:getWeekdays}
}
(function($){
    var date = new daysObj();
    dateVal = date.getDaysInMonth();
    var weekdays = date.getWeekdays();
    console.log(weekdays);
})($);