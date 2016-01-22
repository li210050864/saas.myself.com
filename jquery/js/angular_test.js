function PhoneListCtrl($scope){
	$scope.phones = [
		{
			"name":"Nexus S",
		 	"snippet":"Fast just got faster with Nexus S."
		},
		{
			"name":"Motorola XOOM™ with Wi-Fi",
			"snippet":"The Next, Next Generation tablet.",
		},
		{
			"name":"MOTOROLA XOOM™",
			"snippet":"The Next, Next Generation tablet.",
		}
	];
	$scope.hello = 'Hello World !!!';

}
function WeekCtrl($scope){
	$scope.weeks = [
		{
			"name":"Sunday",
			"no":0,
		},
		{
			"name":"Monday",
			"no":1,
		},
		{
			"name":"Tuesday",
			"no":2,
		},
		{
			"name":"Wednesday ",
			"no":3,
		},
		{
			"name":"Thursday ",
			"no":4,
		},
		{
			"name":"Friday",
			"no":5,
		},
		{
			"name":"Saturday",
			"no":6,
		}
	];
}

function FilterController($scope){
	$scope.students = [
		{
			"name":"Lily","age":13,"sex":"f"
		},
		{
			"name":"HuJun","age":35,"sex":"m"
		},
		{
			"name":"ZhaoWei","age":25,"sex":"f"
		},
		{
			"name":"FanBingBing","age":30,"sex":"f"
		},
		{
			"name":"HuangXiaoMing","age":34,"sex":"m"
		},
		{
			"name":"TongDaWei","age":35,"sex":"m"
		},
		{
			"name":"AngelBaby","age":27,"sex":"f"
		},
		{
			"name":"DengChao","age":28,"sex":"m"
		}
	];
	$scope.orderProp = "age";
}

// function PhoneController($scope,$http){
// 	$http.get('js/phone.json').success(function(data) {
//     	$scope.phonelis = data.splice(0,2);
//   	});
// }
var PhoneController = ["$scope","$http",function($scope,$http){
	$http.get('js/phone.json').success(function(data) {
    	$scope.phonelis = data.splice(0,2);
  	});
}]

angular.module("phoneurl",[]).
config(["$routeProvider",function($routeProvider){
	$routeProvider.
		when("/phonedetail/:phoneId",{
			templateUrl:"phonedetail.html",
			controller:PhoneDetailController,
		}).
		when("/phoneimg/:phoneId",{
			templateUrl:"phoneImg.html",
			controller:PhoneImgController,
		}).
		otherwise("/phone",{
			templateUrl:"phoneList.html",
			controller:PhoneListController,
		});
}])