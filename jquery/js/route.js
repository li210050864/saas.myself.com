var ComputerController = ["$scope","$http",function($scope,$http){
	var json_file = "js/computer.json";
	$http.get(json_file).success(function(data){
		$scope.langs = data;
		$scope.orderProp = "name";
	});
}];
var LangdetailController = ["$scope","$routeParams","$http",function($scope,$routeParams,$http){
	//$scope.computerId = $routeParams.computerId;
	// $http.get("js/lang_"+$routeParams.computerId+".json").success(function(data){
	// 	$scope.langinfo = data;
	// 	$scope.langinfo.mainImg = data.img[0];
	// });
	console.log(computerSer);
	$scope.langinfo = computerSer.query({langId:$routeParams.computerId},function(langinfo){
		$scope.langinfo.mainImg = data.img[0];
	});
	$scope.setImg = function(imgurl){
		$scope.langinfo.mainImg = imgurl;
	}
}];