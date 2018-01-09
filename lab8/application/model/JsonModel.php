<?php

/* set out document type to text/javascript instead of text/html */
header("Content-type: text/javascript");

$carName = $_GET['carName']; 
//$carName = 'Mercedes';

/* our multidimentional php array to pass back to javascript via ajax */

switch ($carName) {
        case "Mercedes":    
                $cars = array(
                        array(
                                "brandName" => "Mercedes",
                                "model" => "C220 AMG",
                                "colour" => "Black"
                        ),
                        array(
                                "brandName" => "Mercedes",
                                "model" => "C220 AMG",
                                "colour" => "Red"
                        )
                );
                break;
        case "BMW":    
                $cars = array(
                        array(
                                "brandName" => "BMW",
                                "model" => "3 Series",
                                "colour" => "Blue"
                        )
                );
                break; 
        case "Toyota":    
                $cars = array(
                        array(
                                "brandName" => "Toyota",
                                "model" => "Camry",
                                "colour" => "White"
                        )
                );
                break;     
        case "Ford":    
                $cars = array(
                        array(
                                "brandName" => "Ford",
                                "model" => "2.0 C-max Titanium",
                                "colour" => "Silver"
                        )
                );
                break; 
        case "Honda":    
                $cars = array(
                        array(
                                "brandName" => "Honda",
                                "model" => "Civic i-DTEC diesel",
                                "colour" => "Grey"
                        )
                );
                break;                       
}
/* encode the array as json. this will output [{"first_name":"Darian","last_name":"Brown","age":"28","email":"darianbr@example.com"},{"first_name":"John","last_name":"Doe","age":"47","email":"john_doe@example.com"}] */
echo json_encode($cars);

?>