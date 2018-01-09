// JavaScript Document
$(document).ready(function(){

	 //AJAX service request to get the main text data from the json data store
	 $.getJSON('./model/data.json', function(jsonObj) {
		
		//Get the home page main text data
		$('#title_home').html('<h2 class ="box_text_h2">' + jsonObj.pageTextData[0].title + '<h2>');
		$('#subTitle_home').html('<h3 class ="box_text_h3">' + jsonObj.pageTextData[0].subTitle + '</h3>');
		$('#description_home').html('<p class ="box_text_p">' + jsonObj.pageTextData[0].description + '</p>');		
		
		//Get the coke main text data
		$('#title_coke').html('<h2 class ="box_text_h2">' + jsonObj.pageTextData[1].title + '<h2>');
		$('#subTitle_coke').html('<h3 class ="box_text_h3">' + jsonObj.pageTextData[1].subTitle + '</h3>');
		$('#description_coke').html('<p class ="box_text_p">' + jsonObj.pageTextData[1].description + '</p>');
 
 		//Get the sprite main text data
		$('#title_sprite').html('<h2 class ="box_text_h2">' + jsonObj.pageTextData[2].title + '<h2>');
		$('#subTitle_sprite').html('<h3 class ="box_text_h3">' + jsonObj.pageTextData[2].subTitle + '</h3>');
		$('#description_sprite').html('<p class ="box_text_p">' + jsonObj.pageTextData[2].description + '</p>');		

		//Get the pepper main text data
 		$('#title_pepper').html('<h2 class ="box_text_h2">' + jsonObj.pageTextData[3].title + '<h2>');
		$('#subTitle_pepper').html('<h3 class ="box_text_h3">' + jsonObj.pageTextData[3].subTitle + '</h3>');
		$('#description_pepper').html('<p class ="box_text_p">' + jsonObj.pageTextData[3].description + '</p>');
 	 
	 });
});