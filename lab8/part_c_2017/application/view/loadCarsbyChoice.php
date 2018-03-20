<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <title>Cars View</title>

 <script>
 $(document).ready(function(){
      $("#select").change(function () {
            //Start Debug: Check that the input is valid
            //alert('Car Model' + ' ' + $(this).val() + ' ' + 'has been selected'); 
            var model = $(this).val();
            console.log('Car Model:', model, 'has been selected');
            //End debug: 

            //Variable to hold the HTML as we build it for inserting into the place holder
            var str = "";
            
            //Process the selection to selct the desired car model
            $("select option:selected").each(function () {
                
                //Start to build the HTML starting with a title
                str += "</br><div><b>Company Name: </b> "+ $(this).text() + "</div>" + "</br>";
                
                //Start Debug: Comment out this test when the code works 
                //document.writeln(str);
                console.log('HTML Title is:', str);
                //End Debug:

                var selection = $(this).text();
                //Start Debug: Check model selection is correct
                //document.write('Selected car model: ' + selection + '</br></br>');
                console.log('Selected car model:', selection);
                //End Debug:

                //Build a Url path to the php model used to read the Car model data, I am using a localhost here, but will need to change this for 
				//users.sussex.ac.uk/~my_user_name/ when I upload to the ITS Web Server, alternative I need to specifiy a relative path
                var carModelUrl = "../application/model/getCarDetails.php?carName=" + selection;
                //Start Debug: Test JSON file
                //var carModelUrl = "http://users.sussex.ac.uk/~martinwh/mobile3dapp/lab7/part_c/my_mvc/application/model/getCarDetails.php?carName=" + selection;
                //var carModelUrl = "http://localhost:8888/lab7/part_c/my_mvc/application/model/getCarDetails.php?carName=" + selection;
                //var carModelUrl = "http://localhost:8888/lab7/part_c/my_mvc/application/model/mercedes.json";
                //End Debug: 

                //Start Debug: Check the Url path to the PHP model (database) is ok
                //document.writeln(carModelUrl);
                console.log('URL to PHP Model is:', carModelUrl);
                //End Debug:

                //Fire the AJAX call with the .getJSON function to get the service response from the Url (to the web server)
                $.getJSON(carModelUrl, function(json) {
                  //Write the HTML handler
                  //Start Debug: Check we got a good service response from JSON
                  //Test JSON data:
                  //var json = '{"brandName":"Mercedes","model":"C220 AMG","colour":"Black"},{"brandName":"Mercedes","model":"C220 AMG","colour":"Red"}'
                  //document.writeln('</br></br>Service request returned Car model data: ', json);
                  console.log('Web service response for car model data: ', json);
                  //End Debug:
                  //Write the handler to display the results in an HTML table — NEED TO RE_WRITE THIS AS DIV TAGS
                  str +="<table style='border: 0px' width='600' height='263' border='1'>";
                  //Build the HTML in a for loop
                  for (var i=0; i<json.length; i++) {
                      str+= "<tr><td width='300' align='center'> "+ (i+1) +"- " + json[i].brandName 
                      + "</td><td width='400' align='center'>" + json[i].model + 
                      " </td><td width='300' align='center'>  " + json[i].colour;
                      str += "</td><td width='300' align='center'> "+
                      "<img width='300px' height='250px' src = '../assets/"
                      +json[i].brandName +".jpg'></img></td></tr>";
                  }
                  //Close off the table
                  str+="</table>";
                  //And return the constructed HTML to the '</div> placeholder </div>'
                  document.getElementById("placeholder").innerHTML=str; 
               });
            });
      });
      //.change();
  });
  </script>


</head>
<body>
   <h1>Choose a car to see more details</h1>
   <b>Select a Brand Name: </b>
        </br></br>
        <form>
        <select id="select">
                <?php 
                    //$data = array("Mercedes", "BMW", "Toyota", "Ford", "Honda");
                    for ($i=0; $i <= count($data); $i++)                                  
                        echo '<option value="'. $data[$i] .'">'. $data[$i] . '</option>';
                ?>
              </select>
           </form>
   
   <div id="placeholder"></br>Insert new car data here</div>
   
</body>
</html>	