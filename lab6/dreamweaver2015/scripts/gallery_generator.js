// JavaScript Document
function getXMLHttp() {
	var xmlHttp
	try {
		xmlHttp = new XMLHttpRequest ();
	} catch (e) {
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				return false;
			}
		}
	}
	return xmlHttp;
}

//obj communicating with server
var xmlHttp = getXMLHttp();
//stores newly generated gallery HTML code
var htmlCode = "";
//temporarily stores server response while code is generated
var response;

$(document).ready(function() {
	var send = "scripts/hook.php";
	xmlHttp.open("GET", send, true);
	xmlHttp.send(null);
	xmlHttp.onreadystatechange = function() {
		if(xmlHttp.readyState == 4) {
			response = xmlHttp.responseText.split("~");
			for (var i=0;i<response.length;i++) {
				htmlCode += '<div class="gallery_cell">';
				htmlCode += '<a href="' + 'gallery_images/' + response[i] +'">';
				htmlCode += '<img src="gallery_images/' + response[i] + '" class="image_thumbnail"/>';
				htmlCode += '</a>';
				htmlCode += '</div>';
			}
			document.getElementById('gallery1').innerHTML = htmlCode;
			document.getElementById('gallery2').innerHTML = htmlCode;
			document.getElementById('gallery3').innerHTML = htmlCode;
			document.getElementById('gallery4').innerHTML = htmlCode;
		}
	}
});

