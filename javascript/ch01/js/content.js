function addLoadEvent(func){
	var oldload = window.onload;
	if(typeof window.onload != 'function'){
		window.onload = func;
	}else{
		window.onload = function(){
			oldload();
			func();
		}
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

function addClass(element,value){
	if(!element.className){
		element.className = value;
	}else{
		element.className += " " + value;
	}
}

function displayAbbreviations(){
	var annreviations = document.getElementsByTagName("abbr");
	if(annreviations.length < 1){
		return false;
	}
	var defs = new Array();
	for(var i = 0;i<annreviations.length;i++){
		if(annreviations[i].childNodes.length < 1 ){
			continue;
		}
		var definition = annreviations[i].getAttribute("title");
		var key = annreviations[i].lastChild.nodeValue;
		defs[key] = definition;
	}
	var dlist = document.createElement("dl");
	for(key in defs){
		var definition = defs[key];
		var dtitle = document.createElement("dt");
		var dtitle_txt = document.createTextNode(key);
		dtitle.appendChild(dtitle_txt);
		var ddesc = document.createElement('dd');
		var ddesc_txt = document.createTextNode(definition);
		ddesc.appendChild(ddesc_txt);
		dlist.appendChild(dtitle);
		dlist.appendChild(ddesc);
	}
	var header = document.createElement("h2");
	var header_txt = document.createTextNode("Abbreviations");
	header.appendChild(header_txt);

	var body = document.getElementsByTagName("body")[0];
	body.appendChild(header);
	body.appendChild(dlist);
}

function displayCitations(){
	var quotes = document.getElementsByTagName("blockquote");
	for(var i = 0; i<quotes.length;i++){
		var cur_quote = quotes[i];
		if(!cur_quote.getAttribute("cite")){
			continue;
		}
		var url = cur_quote.getAttribute("cite");
		var quoteElements = cur_quote.getElementsByTagName("*");
		if(quoteElements.length < 1){
			continue;
		}
		var elem = quoteElements[quoteElements.length - 1];
		var link = document.createElement("a");
		var link_txt = document.createTextNode("source");
		link.appendChild(link_txt);
		link.setAttribute("href",url);
		var superscript = document.createElement("sup");
		superscript.appendChild(link);
		elem.appendChild(superscript);
	}
}

function displayAccesskeys(){
	if(!document.getElementById || !document.createElement || !document.createTextNode){
		return false;
	}
	if(!document.getElementById("navigation")){
		return false;
	}
	var navigation = document.getElementById("navigation");
	var links = navigation.getElementsByTagName("a");
	if(links.length < 1){
		return false;
	}
	var linksArr = new Array();
	var quicklist = document.createElement("ul");
	for(var i = 0; i< links.length;i++){
		var hasAccesskey = (links[i].getAttribute("accesskey")) ? true : false;
		if(hasAccesskey){
			var accesskey = links[i].getAttribute("accesskey");
			var title = links[i].lastChild.nodeValue;
			linksArr[accesskey] = title;
			var str = accesskey + " : " + title;
			var _li = document.createElement("li");
			var _litxt = document.createTextNode(str);
			_li.appendChild(_litxt);
			quicklist.appendChild(_li);
		}
	}
	document.getElementsByTagName("body")[0].appendChild(quicklist);
}

function styleHeaderSiblings(){
	if(!document.getElementsByTagName) return false;
	var headers = document.getElementsByTagName("h1");
	var elem;
	for(var i = 0; i<headers.length;i++){
		elem = getNextElement(headers[i].nextSibling);
		elem.style.fontWeight = "bold";
		elem.style.fontSize = "1em";
	}
}

function stripeTables(){
	if(!document.getElementsByTagName){
		return false;
	}
	var table = document.getElementsByTagName("table");
	var odd,rows;
	for(var i = 0;i < table.length;i++){
		odd = false;
		rows = table[i].getElementsByTagName('tr');
		for(var j = 0;j < rows.length; j++){
			if(odd == true){
				// rows[j].style.backgroundColor = "#FCC";
				addClass(rows[j],"odd");
				odd = false;
			}else{
				// rows[j].style.backgroundColor = "#FFF";
				addClass(rows[j],"event");
				odd = true;
			}
		}
	}
}

function checkAttribute(){
	var para = document.getElementById('example');
	console.log(typeof para.nodeName);
	console.log(typeof para.style);
	console.log(typeof para.style.color);
	console.log(para.style.color);
	console.log(para.style.fontFamily);
	console.log(para.style.marginTop);
	para.style.font = "2em 'Times',serif";
}
// addLoadEvent(displayAbbreviations);
// addLoadEvent(displayCitations);
// addLoadEvent(displayAccesskeys);
addLoadEvent(checkAttribute);
addLoadEvent(styleHeaderSiblings);
addLoadEvent(stripeTables);