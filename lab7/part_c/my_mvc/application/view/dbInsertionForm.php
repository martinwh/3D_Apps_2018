  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  
  <div id="contact_form">
  <form name="contact" action="">
    <fieldset>
    <br><br>
      <label for="brandName" id="name">Brand Name</label>
      <input type="text" name="brandName" id="brandName" size="30" value="" class="text-input" />
      <label class="error" for="brandName" id="name_error">This field is required.</label><br>
      
      <label for="model" id="model_label">Return Email</label>
      <input type="text" name="model" id="model" size="30" value="" class="text-input" />
      <label class="error" for="model" id="model_error">This field is required.</label><br>
      
      <label for="color" id="color_label">Return Phone</label>
      <input type="text" name="color" id="color" size="30" value="" class="text-input" />
      <label class="error" for="color" id="color_error">This field is required.</label><br><br>
      
      <input type="submit" name="submit" class="button" id="submit_btn" value="Send" />
    </fieldset>
  </form>
  </div>
  <script>
    $(function() {
    $(".button").click(function() {
 
	  var dataString = 'brandName='+ brandName + '&model=' + model + '&color=' + color;
	  //alert (dataString);return false;
	  $.ajax({
		type: "GET",
		url: "application/model/dbInsertData.php",
		data: dataString,
		success: function(response) {
		  $('#contact_form').html("<div id='message'></div>");
		  $('#message').html("<h2>Data sent to the model!</h2>")
		  .append("<p>We will be in touch soon.</p>")
		  .hide()
		  .fadeIn(1500, function() {
			$('#message').append("<img id='checkmark' src='images/check.png' />");
		  });
		}
	  });
	  return false;
	  });
   });
  </script>