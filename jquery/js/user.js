angular.module('myApp',[])
.controller('UserController',['$scope','$parse','$interpolate', function($scope,$parse,$interpolate) {
	$scope.$watch('emailBody_first', function(body) {
		if (body) {
			var template = $interpolate(body);
			$scope.previewText = template({to: $scope.to});
		}
	});
}])
.controller('EmailController',['$scope','EmailParser',function($scope,EmailParser){
	$scope.$watch('emailBody',function(body){
		if(body){
			$scope.previewTest = EmailParser.parse(body,{user:$scope.useremail});
		}
	})
}])



angular.module('emailParser',[])
.config(['$interpolateProvider',function($interpolateProvider){
	$interpolateProvider.startSymbol('__');
	$interpolateProvider.endSymbol('__');
}])
.factory('EmailParser',['$interpolate',function($interpolate){
	return {
		parse : function(text,context){
			var template = $interpolate(text);
			return template(context);
		}
	}
}])