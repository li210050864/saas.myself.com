function highlightPage(){
	if(!document.getElementsByTagName || !document.getElementById){
		return false;
	}
	var headers = document.getElementsByTagName('header');
	if(headers.length == 0) return false;
	var navs = headers[0].getElementsByTagName("nav");
	if(navs.length == 0) return false;
	var links = navs[0].getElementsByTagName('a');
	if(links.length == 0) return false;
	var linkurl,currenturl = window.location.href;
	for(var i = 0;i<links.length;i++){
		linkurl = links[i].href;
		if(currenturl.indexOf(linkurl) != -1){
			links[i].className = "here";
			var linktext = links[i].lastChild.nodeValue.toLowerCase();
			document.body.setAttribute("id",linktext);
		}
	}
}

function prepareSlideshow(){
	if(!document.getElementsByTagName || !document.getElementById || !document.getElementById("intro") || !document.createElement){
		return false;
	}
	var intro = document.getElementById("intro");
	var slideshow = document.createElement("div");
	slideshow.setAttribute("id","slideshow");
	var preview = document.createElement("img");
	preview.setAttribute("src","img/slideshow.jpg");
	preview.setAttribute("alt","a glimpse of what awaits you");
	preview.setAttribute('id','preview');
	slideshow.appendChild(preview);
	insertAfter(slideshow,intro);

	var links = intro.getElementsByTagName("a");
	var destination;
	for(var i = 0;i<links.length;i++){
		destination = this.getAttribute("href");
		if(destination.indexOf("home.html") != -1){
			moveElement('preview',0,0,5);
		}
		if(destination.indexOf('about.html') != -1){
			moveElement('preview',-150,0,5);
		}
		if(destination.indexOf('photos.html')!= -1){
			moveElement('preview',-300,0,5);
		}
		if(destination.indexOf('live.html') != -1){
			moveElement('preview',-450,0,5);
		}
		if(destination.indexOf('contact.html') != -1){
			moveElement('preview',-600,0,5);
		}
	}
}

addLoadEvent(highlightPage);
addLoadEvent(prepareSlideshow);