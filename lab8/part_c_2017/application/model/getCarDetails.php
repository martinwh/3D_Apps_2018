	<?php
	
		$carName = $_GET['carName']; 
		//$carName = 'Mercedes';

		/*
			Note: All the echo st aements used for debuging must be commented out once you are sure the code is ok, 
			because the first echo will be returned to the calling view, so in this case the string 'Looking for ...'
			will be returned, which is obvioulsy thenot the JSON packet!
		*/
		//echo 'Looking for model: ' . $carName . '</br></br>';

 		try {		
			//echo 'Making database connection ...</br></br>';
 			//Make a connection to the database
			$dbhandle = new PDO('sqlite:../../db/test1.db', 'user', 'password', array(
    													PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    													PDO::ATTR_EMULATE_PREPARES => false,
														));

			//echo 'Connection to Car database created</br></br>';

			//Create a database schema for SQLite
			//$dbhandle->exec("CREATE TABLE Cars (Id INTEGER PRIMARY KEY, BrandName TEXT, Model TEXT, Colour TEXT)");   
			
			//insert some data into you database
			/**
			$dbhandle->exec(
            	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (1, 'Mercedes', 'C220 AMG', 'Black'); " .
            	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (2, 'Mercedes', 'C220 AMG', 'Red'); " .
  	  	    	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (3, 'Toyota', 'Camry', 'White'); " .
	        	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (4, 'Ford', '2.0 C-max Titanium', 'Silver'); " .
         		"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (5, 'BMW', '3 Series', 'Blue'); " . 
           		"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (6, 'Honda', 'Civic i-DTEC diesel', 'Grey');");   
			**/
			//echo 'Records inserted into Car database</br></br>';

			//View (select or get) all records in from the Cars table
			$sql = 'SELECT * FROM Cars WHERE BrandName = "'. $carName. '"';
			
			//echo 'Making SQL search on database: ' . ' [ ' . $sql . ' ] ' . '</br></br>';

			//Use PDO query() to query the database with the prepared SQL statement
			$stmt = $dbhandle->query($sql);
			
			/*
				Test to check we have read the records from the data base before we pass the result 
				back to the calling function, i.e. View through the Controller. Once you know it is
				working, you can comment it out
			*/
			//foreach ($stmt as $row) {
        	//	print $row['BrandName'] . "\t";
        	//	print $row['Colour'] . "\t";
        	//	print $row['Model'] . "\n" . '</br></br>';
    		//}
    		//echo 'All records printed for brand : ' . $carName . '</br></br>';	
		
			//Set up an array to return the results to the view
			$result = null;
			
			//Set up a variable to index each row of the array
			$i=0;	
			
			//Use PDO fetchall() the results from the database using a while loop
			//Use a while loop to loop through the rows	
			while ($data = $stmt->fetch()) {
				
				//echo $data['BrandName'] . '</br></br>';
				//Write the database contents to the results array for sending back to the view
				$result[$i]['brandName'] = $data['BrandName'];
				$result[$i]['model'] = $data['Model'];
				$result[$i]['colour'] = $data['Colour'];
				
				//increment the row index
				$i++;
				//echo $result[$i]['brandName'] . '</br></br>';
			}
				
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
    	
    	//echo 'Closing the database connection </br></br>';
    	
    	//Close the database connection
		$dbhandle = NULL;
		
		//echo 'Database connection is closed</br></br>';
	
		//Encode the database result into a JSON packet
		//$json1 = json_encode($result);

		//Start Debug: Test the JSON packet is correct
		//echo 'JSON response :' . json_encode($result) . '</br></br>';
		//print_r('Here is the json1 web service response packet: ' . $json1 . '</br></br>');
		
		//$json2 = print_r('Here is the json2 web service response packet: ' . json_encode($result). '</br></br>');
		//echo 'Returning JSON packet to controller: ' . $json2 . '</br></br>';
		//End Debug:

		//Send the response back to the controller
		//return json_encode($result);
		//echo 'Returning JSON response to controller: ';
		//echo $json1;
		//print($json1);
		//print_r($json1);
		echo json_encode($result);

 ?>