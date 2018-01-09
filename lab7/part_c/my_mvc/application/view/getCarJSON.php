<html>
<head>
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>

        <script type='text/javascript'>
        $(document).ready(function(){
            $("#select").change(function () {
                var model = $(this).val();
                $("select option:selected").each(function () {    
                        var selection = $(this).text();
                        console.log('Selected car model:', selection);
                        
						//Use a relative path so that it works on the ITS Web Server, or http://users.sussex.ac.uk/~your_user_name/[insert_rest_of_path]/[php_function]
						var carModelUrl = "../application/model/jsonModel.php?carName=" + selection;
						//var carModelUrl = "http://localhost:8888/lab7/part_c/my_mvc/application/model/jsonModel.php?carName=" + selection;
                        //var carModelUrl = "http://localhost:8888/lab8/tiny_mvc/application/model/getCarDetails.php?carName=" + selection;
                        /* call the php that has the php array which is json_encoded */
                        $.getJSON(carModelUrl, function(json) {
                                console.log('Web service response for car model data: ', json);
                                /* data will hold the php array as a javascript object */
                                $.each(json, function(key, val) {
                                        $('div').append('<p id="' + key + '">' + val.brandName + ' ' + val.model + ' ' + val.colour + '</p>');
                                });
                        });
                });        
            });
        });
        </script>

</head>

<body>
<h1>Choose a car to see more details </h1>
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
        <!-- this div will be populated with the data from the php array -->
        <div></div>

</body>
</html>