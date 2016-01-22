angular.module("compute",['ngRoute','computerFilter','computerService']).
config(['$routeProvider', function($routeProvider) {
	$routeProvider.when("/computer/:computerId",{
		templateUrl:"detail.html",
		controller:"LangdetailController",
	}).when("/computer",{
		templateUrl:"list.html",
		controller:"ComputerController",
	}).otherwise({redirectTo: '/computer'});
}]);

angular.module("computerFilter",[]).
filter("checkmark",function(){
	return function(input){
		return input? '\u2713' : '\u2718';
	}
});
angular.module('computerService', []).
factory('computerSer',['$resource',function($resource){
	return $resource("js/lang_1.json",{},{
		query:{method:"post",params:{langId:'langs'},isArray:true}
	});
}])
