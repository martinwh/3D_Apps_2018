<?php
class Model {
	// Property declaration, in this case we are declaring a variable that points to the database connection
	public $dbhandle;
	//method to create database connection using PHP data Objects (PDO) as the interface to SQLite
	public function __construct()
	{
		try {	
			//You can change the connection string for diferent databases, currently using SQLite
			$this->dbhandle = new PDO('sqlite:./db/testX.sqlite', 'user', 'password', array(
    													PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    													PDO::ATTR_EMULATE_PREPARES => false,
														));
			//$this->dbhandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo 'Car database created</br></br>';
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
    }
	
	//A default Method to simulate the car data model
	public function car_info()
	{
		// Simulate the model's data
		return array(
			'car1' => 'Mercedes',
			'car2' => 'Toyota',
			'car3' => 'Ford',
			'car4' => 'BMW',
			'car5' => 'Honda'
		);
	}
	//Method to create a table using the PDO exec function
	public function dbCreateTable()
	{	
		try {
			$this->dbhandle->exec("CREATE TABLE Cars (Id INTEGER PRIMARY KEY, BrandName TEXT, Model TEXT, Color TEXT)");	
			return "A table named cars is successfully created inside TestX.db file";
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
		$this->dbhandle = NULL;
	}	
	
	//Simple method to insert data using the PDO exec function, could use a form, or a loop to insert the data.
	public function dbInsertData()
	{
		try {
            $this->dbhandle->exec("INSERT INTO Cars (Id, BrandName, Model, Color) VALUES (1, 'Mercedes', 'C220 AMG', 'Black'); " .
  	  	    "INSERT INTO Cars (Id, BrandName, Model, Color) VALUES (2, 'Toyota', 'Camry', 'White'); " .
	        "INSERT INTO Cars (Id, BrandName, Model, Color) VALUES (3, 'Ford', '2.0 C-max Titanium', 'Silver'); " .
         	"INSERT INTO Cars (Id, BrandName, Model, Color) VALUES (4, 'BMW', '3 Series', 'Blue'); " . 
            "INSERT INTO Cars (Id, BrandName, Model, Color) VALUES (5, 'Honda', 'Civic i-DTEC diesel', 'Grey');");   
			return "Data inserted successfully inside TestX.db file";
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
		$this->dbhandle = NULL;
	}
	
	public function dbGetData()
	{
		try {
   			//Read all of the data from the Cars table and print it in an HTML table
   			//print "<table border=1>";
			//print "<tr><td>Id</td><td>Brand</td><td>Model</td><td>Color</td></tr>";
			
			//Use prepared statements and binding to get data from the database to prevent sql injection attacks
			//Here's a good video: http://www.youtube.com/watch?v=GBDbclDfc84 that explains loosely the concepts
			//Also, this explanation is not too bad either: http://prash.me/php-pdo-and-prepared-statements/
			
			//Get the database as an object
			$sql = 'SELECT * FROM Cars';
			$stmt = $this->dbhandle->query($sql);
			
			//Example fetching one result
			//$data = $stmt->fetch();
			//echo $data['BrandName'];	
			
			//Example fetching all results using a while loop			
			//while ($data = $stmt->fetch()) {
			//	echo '</br>' . $data['BrandName'];
			//}		

			//Example fetching one particular result
			//First fetch the all data from the object
			//$data = $stmt->fetchAll();
			//echo $data[3]['Model'];

			//All results with a foreach loop
			//foreach ($data as $row) {
			//	echo '</br>' . $row['BrandName'] . $row['Model'] . $row['Color'];
			//	
			//}

			//Now print all results to a HTML table with a foreach loop
			$data = $stmt->fetchAll();
			$result = null;
			$i = 0;
			foreach($data as $row)
			{
				//print "<tr>
	       	   	//	   <td>".$row['Id']."</td>"; 
				//print "<td>".$row['BrandName']."</td>"; 
	    		//print "<td>".$row['Model']."</td>"; 
	   			//print "<td>".$row['Color']."</td>
	          	//	   </tr>";
    			$result[$i]['brandName'] = $row['BrandName'];
				$result[$i]['model'] = $row['Model'];
				$result[$i]['color'] = $row['Color'];
				$i++;   		
    		}
			print "</table>";
			return $result;		
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
		$this->dbhandle = NULL;
	}
}
?>
