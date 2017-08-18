function showPic(whichpic){
	if(!document.getElementById("placeholder")){
		return false;
	}
	var placeholder = document.getElementById("placeholder");
	// if(placeholder.nodeName != "IMG"){
	// 	return false;
	// }
	var source = whichpic.getAttribute("href");
	placeholder.setAttribute("src",source);
	placeholder.style.width="735px";
	if(document.getElementById("description")){
		var text ="";
		// if(whichpic.getAttribute("title")){
			 text = whichpic.getAttribute("title");
		// }
		var description = document.getElementById("description");
		// if(description.nodeType == 3){
			description.firstChild.nodeValue = text;	
		// }
	}
	return true;
}

function prepareGallery(){
	// if(!document.getElementsByTagName || !document.getElementById) return false;
	// var supported = document.getElementsByTagName && document.getElementById;
	// if(!supported) return false;
	if(!document.getElementsByTagName){
		return false;
	}
	if(!document.getElementById){
		return false;
	}
	if(!document.getElementById("imagegallery")){
		return false;
	}
	var gallery = document.getElementById("imagegallery");
	var links = gallery.getElementsByTagName("a");
	for(var i = 0;i< links.length;i++){
		links[i].onclick = function(){
			return !showPic(this);
		}
		// links[i].onkeypress = links[i].onclick;
	}
}
// window.onload = prepareGallery;
// prepareGallery();

function addLoadEvent(func){
	var oldonload = window.onload;
	if(typeof window.onload != 'function'){
		window.onload = func;
	}else{
		window.onload = function(){
			oldonload();
			func();
		}
	}
}

function insertAfter(newElement,targetElement){
	var parent = targetElement.parentNode;
	if(parent.lastChild == targetElement){
		parent.appendChild(newElement);
	}else{
		parent.insertBefore(newElement,targetElement.nextSibling);
	}
}

function getHTTPObject(){
	if(typeof XMLHttpRequest == "undefined"){
		XMLHttpRequest = function(){
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
			return false;
		}
	}
	return new XMLHttpRequest();
}


function insertParagraph(text){
	var str = "<p>" + text + "</p>";
	document.write(str);
}

function getInnerhtml(){
	if(!document.getElementById || !document.getElementById("test")){
		return false;
	}
	var test = document.getElementById("test");
}

function createEle(){
	if(!document.createElement) return false;
	if(!document.getElementById) return false;
	if(!document.createTextNode) return false;
	var para = document.createElement("p");
	var testDiv = document.getElementById("test");
	var text = document.createTextNode("Hello world");
	testDiv.appendChild(para);
	para.appendChild(text);
	// var info = "nodeName : " + para.nodeName + "; nodeType : " + para.nodeType;
	// console.log(info);
}


function preparePlaceholder(){
	if(!document.createElement){
		return false;
	}
	var img = document.createElement("img");
	img.setAttribute("id","placeholder");
	img.setAttribute("src","./img/placeholder.gif");
	img.setAttribute("alt","this is my img placeholder");
	var p = document.createElement("p");
	p.setAttribute("id","description");
	var text = document.createTextNode(" Choose an image.");
	p.appendChild(text);
	document.body.appendChild(img);
	document.body.appendChild(p);
}

function preparePlaceholder2(){
	if(!document.getElementById){
		return false;
	}
	if(!document.getElementById("imagegallery")){
		return false;
	}
	var placeholder = document.createElement("img");
	placeholder.setAttribute("id","placeholder2");
	placeholder.setAttribute("src","./img/bigben.jpg");
	placeholder.setAttribute("alt","this is my img placeholder");
	placeholder.setAttribute("width","735px");
	var description = document.createElement("p");
	description.setAttribute("id","description2");
	var desctext = document.createTextNode("Choose an image");
	description.appendChild(desctext);
	var gallery = document.getElementById("imagegallery");
	// gallery.parentNode.insertBefore(placeholder,gallery);
	insertAfter(placeholder,gallery);
	insertAfter(description,placeholder);
}

function getNewContext(){
	var request = new getHTTPObject();
	console.log(request);
	if(request){
		request.open("GET","./test.txt",true);
		request.onreadystatechange = function(){
			if(request.readyState == 4){
				var para = document.createElement("p");
				var text = document.createTextNode(request.responseText);
				para.appendChild(text);
				document.getElementById("new").appendChild(para);
			}
		};
		request.send(null);
	}else{
		insertParagraph("Sorry,your browser doesn't support XMLHttpRequest");
	}
}

addLoadEvent(preparePlaceholder);
// addLoadEvent(preparePlaceholder2);
addLoadEvent(prepareGallery);
// addLoadEvent(insertParagraph("This is docu,ment write function"));
// addLoadEvent(getInnerhtml);
// addLoadEvent(createEle)
addLoadEvent(getNewContext);
