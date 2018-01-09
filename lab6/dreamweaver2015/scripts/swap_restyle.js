// JavaScript Document
var counter = 0;

function swap(selected) {
	document.getElementById('home').style.display = 'none';
	document.getElementById('coke').style.display = 'none';
	document.getElementById('sprite').style.display = 'none';
	document.getElementById('pepper').style.display = 'none';	
	document.getElementById(selected).style.display = 'block';
}
function changeLook() {
	counter += 1;
	switch (counter) {
        case 1:
            document.getElementById('body').style.backgroundColor = 'lightblue';
			document.getElementById('header').style.backgroundColor = '#FF0000';
			document.getElementById('footer').style.backgroundColor = '#FF9900';
            break;
        case 2:
			document.getElementById('body').style.backgroundColor = '#FF6600';
			document.getElementById('header').style.backgroundColor = '#FF9999';
			document.getElementById('footer').style.backgroundColor = '#996699';
            break;
        case 3:
			document.getElementById('body').style.backgroundColor = 'coral';
			document.getElementById('header').style.backgroundColor = 'darkcyan';
			document.getElementById('footer').style.backgroundColor = 'darksalmom';
            break;
        case 4:
            counter = 0;
			document.getElementById('body').style.backgroundColor = 'lightgrey';
			document.getElementById('header').style.backgroundColor = 'chocolate';
			document.getElementById('footer').style.backgroundColor = 'dimgrey';
            break;
    }
}

function changeBack() {
	document.getElementById('body').style.backgroundColor = '#FFFFFF';
	document.getElementById('header').style.backgroundColor = 'rgba(175,0,0,1)';
	document.getElementById('footer').style.backgroundColor = 'rgba(175,0,0,1)';
}