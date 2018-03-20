<!DOCTYPE html>
<html>
<head>
  <style>img { height: 100px; float: left; }</style>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <title> Flickr Web Service </title>
</head>
<body>
	<h1> Flickr Web Service</h1>
    <h3> Search on Flickr Feed</h3>
	<input type="text" id="txt" />
 	<button onclick="loadimages()">Search</button>
  	<div id="images"></div>

	<script language="javascript">
    function loadimages()
    {
        var txt = document.getElementById('txt').value
        $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?",
          {
            tags: txt,
            tagmode:"all",
            format: "json"
          },
          function(data) {
            $.each(data.items, function(i,item){
              $("<img/>").attr("src", item.media.m).appendTo("#images");
              if ( i == 3 ) return false;
            });
          });
    }
    </script>
</body>
</html>
<!-- Flickr webservice http://www.flickr.com/services/feeds/docs/photos_public/ -->