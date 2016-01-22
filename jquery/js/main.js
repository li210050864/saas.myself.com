function doSomething(){
	"use strict";
	//alert("使用严格模式");
	//alert(null == undefined);
	//var MAX = Number.MAX_VALUE;
	//alert(MAX);
	var number_str = "123a";
	var number = Number(number_str);
	//alert(number);
	// var number_value = parseInt(number_str);
	// alert(number_value);
	// var num = -18;
	// alert(num.toString(2));
	var book = {};
	Object.defineProperties(book,{
		_year:{
			value:2004
		},
		edition:{
			value:1
		},
		year:{
			get:function(){
				return this._year;
			},
			set:function(newValue){
				 if(newValue > 2004){
					return this._year;
				 }
			}
		}
	});
	console.log("The Book Type Is:");
	console.log(typeof book);
	var descriptor = Object.getOwnPropertyDescriptor(book,"_year");
	//console.log(descriptor);
	console.log(typeof descriptor.get);
	// delete book._year;
	book.year = 2005;
	//console.log(book.edition);
	var descriptor_year = Object.getOwnPropertyDescriptor(book,"year");
	console.log(descriptor_year);
	console.log(typeof descriptor_year.get);

	function createPerson(name,age,job){
		var o = new Object();
		o.name = name;
		o.age = age;
		o.job = job;
		o.sayName = function(){
			console.log(this.name);
		}
		return o;
	}
	var person1 = createPerson("Nicholas",29,"Software Manage");
	console.log(person1);
	console.log("The Person Type Is:");
	console.log(typeof person1);
}

function createObject(){
	function Person(name,age,job){
		this.name = name;
		this.age = age;
		this.job = job;
		this.sayName = function(){
			console.log(this.name);
		}
	}
	var person1 = new Person("Greg","27","Doctor");
	var person2 = new Person("ZSLH","28","Songer");
	console.log("The two person is not one!");
	console.log(person1.sayName == person2.sayName);
	console.log(person1);
	console.log(person1 instanceof Person);
	person1.sayName();

	Person("LMX","30","SoftWare");
	Person("GML","28","SoftWare");
	window.sayName();

	var o = new Object();
	Person.call(o,"LBM",25,"Nurse");
	o.sayName();
}

function ModeObject(){
	function Person(){}
	Person.prototype.name = "Nicholas";
	Person.prototype.age = 30;
	Person.prototype.job = "Software Manage";
	Person.prototype.sayName = function(){
		console.log(this.name);
	}
	var person1 = new Person();
	person1.sayName();
	var person2 = new Person();
	person2.sayName();

	console.log(person1.sayName == person2.sayName);
	person1.name = "NewName";
	person1.sayName();
	person2.sayName();
	console.log(person1.sayName == person2.sayName);
	console.log(person1);
	console.log(person2);
}

function Attribute(){
	function Person(){}
	Person.prototype.name = "ChenLin";
	Person.prototype.age = 38;
	Person.prototype.job = "Singer";
	Person.prototype.sayName = function(){
		console.log(this.name);
	}
	var person1 = new Person();
	var person2 = new Person();
	person1.name = "LiuDeHua";
	console.log(person1.hasOwnProperty("name"));
	console.log(person2.hasOwnProperty("name"));
	console.log(Object.getOwnPropertyDescriptor(person1,"name"));
}
function hasPrototypeProperty(object,name){
	return !object.hasOwnProperty(name) && (name in object)
}
function FunForIn(){
	function Person(){}
	Person.prototype.name = "ChenLin";
	Person.prototype.age = 38;
	Person.prototype.job = "Singer";
	Person.prototype.sayName = function(){
		console.log(this.name);
	}
	var person1 = new Person();
	var person2 = new Person();
	person1.name = "ZhangJie";
	//console.log(person1.hasOwnProperty("name"));
	//console.log("name" in person1);
	console.log(hasPrototypeProperty(person1,"name"));
}
var Ajax = function(){
	if(window.ActiveXobject){
		xmlHttpReg = new ActiveXobject("Microsoft.XMLHTTP");
	}else if(window.XMLHttpRequest){
		xmlHttpReg = new XMLHttpRequest();
	}
	if(xmlHttpReg != null){
		xmlHttpReg.open("get","http://www.duba.com/main2_pannel.html?pi=2&index=3&type=http&_=20151110122945","jsonp",true);
		xmlHttpReg.send(null);
		xmlHttpReg.onreadystatechange = function(){
			if(xmlHttpReg.readyState == 4){
				if(xmlHttpReg.status == 200){
					console.log(xmlHttpReg.responseText);	
				}
			}
		}
	}
}
function getNews(){
	Ajax();
}
function ForInFun(){
	var o = {
		toString:function(){
			console.log("function toString");
			return "My Object";
		}
	};
	for(var pro in o){
		if(pro == "toString"){
			var str = o.toString();
			console.log(str);
		}
	}
	function Person(){}
	Person.prototype.name = "LiuXiJun";
	Person.prototype.age = 35;
	Person.prototype.job = "Software Manage";
	Person.prototype.sayName = function(){
		console.log(this.name);
	}
	var keys = Object.keys(Person.prototype);
	console.log(keys);
	var p1 = new Person();
	p1.name = "MeiYanFang";
	p1.age = "50";
	var p1key = Object.keys(p1);
	console.log(p1key);
	console.log(Object.getOwnPropertyNames(Person.prototype));
}

function OrgObject(){
	console.log(typeof Array.prototype.sort);
	console.log(String.prototype.substring);
	String.prototype.startWidth = function(text){
		return this.indexOf(text) == 0;
	}
	var msg = "Hello world!";
	console.log(msg.startWidth("world"));
	function Person(){}
	Person.prototype = {
		constructor:Person,
		name:"ZhaoWei",
		age:"35",
		job:"Singer",
		friends:["HuangXiaoMing","ChenKun"],
		sayName:function(){
			console.log(this.name);
		}
	};
	var person1 = new Person();
	var person2 = new Person();
	person1.friends.push("LiuDeHua");
	console.log(person1.friends);
	console.log(person2.friends);
}

function DonMode(){
	function Person(name,age,job){
		this.name = name;
		this.age = age;
		this.job = job;
		if(typeof this.sayName != "function"){
			Person.prototype.sayName = function(){
				console.log(this.name);
			}
		}
	}
	var friend = new Person("MaoNing",40,"Singer");
	friend.sayName();

}

function ParasiticMode(){
	function Person(name,age,job){
		var o = new Object();
		o.name = name;
		o.age = age;
		o.job = job;
		o.sayName = function(){
			console.log(this.name);
		}
		return o;
	}
	var friend = new Person("NaYing",40,"Singer");
	friend.sayName();

	function SpecialArray(){
		var values = new Array();
		values.push.apply(values,arguments);
		values.toPipedString = function(){
			return this.join("|");
		}
		return values;
	}
	var colors = new SpecialArray("red","blue","green");
	console.log(colors.toPipedString());
}

function DurableObject(){
	function Person(name,age,job){
		var o = new Object();
		o.sayName  = function(){
			console.log(name);
		}
		return o;
	}
	var friend = Person("DengChao",35,"Singer");
	friend.sayName();
}

function Prototype(){
	function SuperType(){
		this.colors = ["red","blue","green"];
		this.property = true;
	}
	SuperType.prototype.getSuperValue = function(){
		return this.property;
	}
	function SubType(){
		this.subproperty = false;
	}
	SubType.prototype = new SuperType();

	// SubType.prototype.getSubValue = function(){
	// 	return this.subproperty;
	// }
	// SubType.prototype = {
	// 	getSubValue:function(){
	// 		return this.subproperty;
	// 	},
	// 	getSuperValue:function(){
	// 		return "SubType function";
	// 	},
	// 	otherMethod:function(){
	// 		return false;
	// 	}
	// };
	var instance = new SubType();
	console.log(instance.getSuperValue());
	console.log(instance.colors);
	//instance.colors.push("black");
	console.log(instance.colors);
	// console.log(instance.toString());
	// console.log(instance instanceof Object);
	// console.log(instance instanceof SubType);
}

function StealConstruct(){
	function SuperType(){
		this.colors = ["red","blue","green"];
	}
	function SubType(){
		SuperType.call(this);
	}
	var instance = new SubType();
	instance.colors.push("black");
	console.log(instance.colors);
	var instance_new = new SubType();
	console.log(instance_new.colors);
}

function Combination(){
	function SuperType(name){
		this.name = name;
		this.colors = ["red","blue","green"];
	}

	SuperType.prototype.sayName = function(){
		console.log(this.name);
	}

	function SubType(name,age){
		SuperType.call(this,name);
		this.age = age;
	}

	SubType.prototype = new SuperType();

	SubType.prototype.sayAge = function(){
		console.log(this.age);
	}

	SubType.prototype.sayName = function(){
		console.log("SubType Name IS:"+this.name);
	}

	var instance = new SubType("JiangYuHeng",50);
	console.log(instance.colors);

	instance.colors.push("black");
	console.log(instance.colors);

	instance.sayName();
	instance.sayAge();

	var instance2 = new SubType("LiuDeHua",48);
	instance2.sayName();
	console.log(instance2.colors);

	var parentInstance = new SuperType("ZhengXiuWen",45);
	parentInstance.sayName();
}

function PrototypeIns(){
	function object(o){
		function F(){}
		F.prototype = o;
		return new F();
	}

	var person = {
		name : "MaoNing",
		friends:["YangYuYing","CaiGuoQing"]
	};

	var anotherPerson = object(person);
	anotherPerson.name = "SunHongLei";
	anotherPerson.friends.push("HaiQing");

	console.log(anotherPerson.friends);
	console.log(person.friends);
}

function Parasitic(){
	function object(o){
		function F(){}
		F.prototype = o;
		return new F();
	}

	function createAnother(original){
		var clone = object(original);
		clone.sayHi = function(){
			console.log("Hi");
		};
		return clone;
	}

	var person = {
		name:"SuRui",
		friends:["NaYing","PengJiaHui"]
	};
	var anotherPerson = createAnother(person);
	console.log(anotherPerson.name);
	anotherPerson.sayHi();
}

function BaseFunc(){
	function showname(){}
	console.log(showname.name);
}

var FuncDeclara = function(){
	console.log("this is function declaration");
}

var RecursiveFunc = function(num){
	if(num <= 1){
		return 1;
	}else{
		return num * RecursiveFunc(num - 1);
	}
}

var compareFunc = function(){
	function compare(val1,val2){
		console.log(arguments);
		if(val1 < val2){
			return -1;
		}else if(val1 > val2){
			return 1;
		}else{
			return 0;
		}
	}
	var result = compare(10,20);
	console.log(result);
}

function FuncClosure(){
	function createFunction(){
		var result = new Array();
		for(var i = 0;i<10;i++){
			result[i] = function(num){
				return function(){
					return num;
				};
			}(i);
		}
		return result;
	}
	createFunction();
}
var age = 29;
//var newValue = oldValue;
var newValue = window.oldValue;
console.log(newValue);
function GlobalFunc(){
	window.color = "red";
	delete window.color;
	console.log(window.age);
	console.log(window.color);
}

function FuncWindow(){

}