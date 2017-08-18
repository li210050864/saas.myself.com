function addLoadEvent(func){
	var oldonload = window.onload;
	if(typeof window.onload != "function"){
		window.onload = func;
	}else{
		window.onload = function(){
			oldonload();
			func();
		}
	}
}

function getHttpObject(){
	if(typeof XMLHttpRequest == "undefined"){
		var XMLHttpRequest = function(){
			try{
				return new ActiveXObject("Msxml2.XMLHTTP.6.0");
			}catch(e){

			}
			try{
				return new ActiveXObject("Msxml2.XMLHTTP.3.0");
			}catch(e){

			}
			try{
				return new ActiveXObject("Msxml2.XMLHTTP");
			}catch(e){

			}
			return null;
		}
	}
	return new XMLHttpRequest();
}

function insertAfter(element,target){
	var parent = target.parentNode;
	if(parnet.lastChild == target){
		parent.appendChild(element);
	}else{
		parent.insertBefore(element,target.nextSibling);
	}
}

function getNextElement(node){
	if(node.nodeType == 1){
		return node;
	}
	if(node.nextSibling){
		return getNextElement(node.nextSibling);
	}
	return null;
}

function addClass(element,classname){
	if(element.className){
		element.className += " " + classname;
	}else{
		element.className = classname;
	}
}
// var movement = null;
function moveElement(elemid,targetLeft,targetTop,settime){
	if(!document.getElementById){
		return false;
	}
	if(!document.getElementById(elemid)){
		return false;
	}

	var elem = document.getElementById(elemid);
	if(elem.movement){
		clearTimeout(elem.movement);
	}
	if(!elem.style.left){
		elem.style.left = "0px";
	}
	if(!elem.style.top){
		elem.style.top = "0px";
	}
	var xpos = parseInt(elem.style.left),ypos = parseInt(elem.style.top);
	var dist = 0;
	// if(xpos == targetLeft || ypos == targetTop){
	if(xpos == targetLeft){
		return true;
	}
	if(xpos < targetLeft){
		// xpos++;
		dist = Math.ceil((targetLeft - xpos) / 10);
		xpos = xpos + dist;
	}
	if(xpos > targetLeft){
		// xpos--;
		dist = Math.ceil((xpos - targetLeft) / 10);
		xpos = xpos - dist;
	}
	
	if(ypos < targetTop){
		// ypos++;
		dist = Math.ceil((targetTop - ypos) / 10);
		ypos = ypos + dist;
	}
	if(ypos > targetTop){
		// ypos--;
		dist = Math.ceil((targetTop - ypos) / 10);
		ypos = ypos - dist;
	}
	elem.style.left = xpos + "px";
	elem.style.top = ypos + "px";
	var repeat = "moveElement('"+elemid+"',"+targetLeft+","+targetTop+","+settime+")";
	elem.movement = window.setTimeout(repeat,settime);
}

function positionMessage(){
	if(!document.getElementById){
		return false;
	}
	if(!document.getElementById("message")){
		return false;
	}
	var elem = document.getElementById("message");
	elem.style.position = "absolute";
	elem.style.top = "350px";
	elem.style.left = "100px";
	// movement = window.setTimeout("moveMessage()",10);
	moveElement("message",200,500,10);
}
function moveMessage(){
	if(!document.getElementById){
		return false;
	}
	if(!document.getElementById("message")){
		return false;
	}
	var elem = document.getElementById("message");
	var xpos = parseInt(elem.style.left);
	if(xpos == 200){
		return true;
	}
	if(xpos < 200){
		xpos++;
	}
	if(xpos > 200){
		xpos--;
	}
	elem.style.left = xpos + "px";
	movement = setTimeout("moveMessage()",10);
}

function prepareSlideshow(){
	if(!document.getElementsByTagName) return false;
	if(!document.getElementById) return false;
	if(!document.getElementById("linklist")) return false;
	if(!document.getElementById("preview")) return false;

	var preview = document.getElementById("preview");
	preview.style.position = "absolute";
	preview.style.left = "0px";
	preview.style.top = "0px";

	var list = document.getElementById("linklist");
	var links = list.getElementsByTagName("a");
	links[0].onmouseover = function(){
		moveElement("preview",-200,0,5);
	}
	links[1].onmouseover = function(){
		moveElement("preview",-400,0,5);
	}
	links[2].onmouseover = function(){
		moveElement("preview",-600,0,5);
	}
}
function draw(){
	var canvas = document.getElementById("draw-in-me");
	if(canvas.getContext){
		var cxt = canvas.getContext('2d');
		cxt.beginPath();
		cxt.moveTo(120.0,32.0);
		cxt.bezierCurveTo(120.0,36.4,120.0,40.0,112.0,40.0);
		cxt.lineTo(8.0,40.0);
		cxt.bezierCurveTo(3.6,40.0,0.0,36.4,0.0,32.0);
		cxt.lineTo(0.0,8.0);
		cxt.bezierCurveTo(0.0,3.6,3.6,0.0,8.0,0.0);
		cxt.lineTo(110.0,0.0);
		cxt.bezierCurveTo(116.4,0.0,120.0,3.6,120.0,8.0);
		cxt.lineTo(120.0,32.0);
		cxt.closePath();
		cxt.fill();
		cxt.lineWidth = 2.0;
		cxt.strokeStyle = "rgb(255,255,255)";
		cxt.stroke();
	}else{
		console.log("The browser is not support canvas");
	}
}


addLoadEvent(positionMessage);
addLoadEvent(prepareSlideshow);
addLoadEvent(draw);