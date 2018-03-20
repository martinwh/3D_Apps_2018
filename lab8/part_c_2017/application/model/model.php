<?php

/*
  This pdo_model.php file offer a level of abstraction on top of the chosen database, which is SQLite, by providing a
  simple PHP PDO wrapper class.  This wrapper class can be used to get started with PDO by providing common methods you
  might to need to get going. By using this PDO wrapper class, we are effectively using two layers of abstraction, the class itself and PDO.

  If you searh the InterWeb carefully, you will find many useful resource where they provide similar, maybe even better PDO wrapper calsses,
  here is an intresting tutorial that delivers the same thing: http://culttt.com/2012/09/24/prevent-php-sql-injection-with-pdo-prepared-statements/
  and provides another discuss on Preventing PHP SQL Injection with PDO Prepared Statements.

  Here is another intresting tutorial: http://code.tutsplus.com/tutorials/why-you-should-be-using-phps-pdo-for-database-access--net-12059
*/

class Model {
	//Property declaration, in this case we are declaring a variable that points to the database connection, this will become a PDO object
	public $dbhandle;
	
	//Method to create database connection using PHP Data Objects (PDO) as the interface to SQLite
	public function __construct()
	{
		//Set up the database source name (DSN)
		$dsn = 'sqlite:./db/test1.db';
		
		//Then create a connection to a database with the PDO() function
		try {	
			//Change connection string for different databases, currently using SQLite
			$this->dbhandle = new PDO($dsn, 'user', 'password', array(
    													PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    													PDO::ATTR_EMULATE_PREPARES => false,
														));
			
			/*You should always use exceptions to handle error by wrapping your PDO in a try/catch block
				where the catch is used to process the error message.  PDO can be forced into an error mode, in this case
				we are specofying the PDO::ERRMODE_EXCEPTION, which is used in most situations.  You can use the setattribute() to 
				set the error mode, or input it as an elemne nt in the arracy as the fourth attribute in the PDO() function above.

				Also, use the PDO::ATTR_EMULATE_PREPARES => false to guard against SQL injections
			*/	
			//$this->dbhandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo 'Car database created</br></br>';
		}
		catch (PDOEXception $e) {
			echo "I'm sorry, Martin. I'm afraid I can't connect to the database!";
			//Gnerate an error message if the connection fails
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

	//This is a simple fix to represent, what would in reality be, a table in the database containing the BrandNames.  
	//The database schema would then contain a foreign key for each car entry linking back to the BrandName
	//This stuture allows us to read the list of BrandNames to populate a menu in a view
	public function getBrandNames()
	{
		// Return the car Brand Names
		return array("-", "Mercedes", "BMW", "Toyota", "Ford", "Honda");
	}

	//Method to create a database schema (i.e. a table) using the PDO exec function
	public function dbCreateTable()
	{	
		try {
			$this->dbhandle->exec("CREATE TABLE Cars (Id INTEGER PRIMARY KEY, BrandName TEXT, Model TEXT, Colour TEXT)");	
			return "A table named cars is successfully created inside Test1.db file";
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
		$this->dbhandle = NULL;
	}	
	
	//Method to insert data records into the table using the PDO exec() function
	public function dbInsertData()
	{
		try {
			// You should re-write this to use prepared statements here
            $this->dbhandle->exec(
            	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (1, 'Mercedes', 'C220 AMG', 'Black'); " .
            	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (2, 'Mercedes', 'C220 AMG', 'Pink'); " .
  	  	    	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (3, 'Toyota', 'Camry', 'White'); " .
	        	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (4, 'Ford', '2.0 C-max Titanium', 'Silver'); " .
         		"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (5, 'BMW', '3 Series', 'Blue'); " . 
           		"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (6, 'Honda', 'Civic i-DTEC diesel', 'Grey');");   
			return "Data inserted successfully inside Test1.db file";
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
		$this->dbhandle = NULL;
	}
	
	public function dbGetData()
	{
		try {		
			//Advisory note: You should really use prepared statements and binding to get data from the database to prevent sql injection attacks
			//Here's a good video: http://www.youtube.com/watch?v=GBDbclDfc84 that explains loosely the concepts
			//Also, this explanation is not too bad either: http://prash.me/php-pdo-and-prepared-statements/
			
			//Prepare the SQL statement to Select all the data '*' from the database
			/*You could prepare lot's of these SQL query statements as public variables, this link provides an interesting simple discussion 
				on the 10 most used SQL queries: https://blog.udemy.com/sql-queries/ you can use after creating a table:
				
				CREATE TABLE student (Id INTEGER PRIMARY KEY, BrandName TEXT, Model TEXT, Colour TEXT)");

				These SQL statements are all variations of the basic CRUD (Create, Read, Update and Delete) methods.
				
				1.	Inserting records in a table:	
						
						INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (1, 'Mercedes', 'C220 AMG', 'Black');

				2.	Viewing all records in from a table
						
						SELECT * FROM Cars;

					We can also use ORDER BY clause in our SELECT statement to arrange the displyed result in a particular order, default is increasing order
						
						SELECT * FROM Cars ORDER BY yearRegistered;

					Assuming we had this value in the table (yearRegistered)

				3.	Viewing only selected records from a table, there are many example you could exploit:
						
						SELECT COUNT(1) FROM cars;

					Will return record 1, i.e. Mercedes C220 AMG Black
					If you have a numeric column you can use MAX, MIN and SUM functions
						
						SELECT max(yearRegistered) FROM Cars;

				4. Deleting records from a table
	
						DELETE FROM Cars WHERE BrandName = ‘Mercedes’;

					This will delete any rows Model column has the value 'Mercedes', this will leave a table looking like:

					ID 	Name 		Model 				Colour
					2 	Mercedes 	C220 AMG 			Red
					3	Toyota  	Camry   			White
					4  	Ford    	2.0 C-max Titanium  Silver
					5 	BMW  		3 Series 			Blue
					6 	Honda 		Civic i-DTEC diesel Grey

				5. Changing data in existing records in a table

						UPDATE Cars SET Model = '5 Series' WHERE BrandName = ‘BMW’;

				   This will update the BMW record to show the model as a 5 Series

				   Quote: Be careful while you are firing UPDATE or DELETE queries with the help of the WHERE clause. 
				   Suppose in our table ‘Cars’ there is more than one car with BrandName ‘BMW’. In this case, Model of all cars with the BrandName ‘3 Series’
				   will be updated to 5 Series. That is why it is always preferred to use PRIMARY KEY in WHERE clause while updating or deleting. [https://blog.udemy.com/sql-queries/]

				6. Viewing records from a table without knowing exact details

				   		SELECT * FROM Cars WHERE Model LIKE ‘C%’;

				   This will return all cars whos Model begins with C	

				7. Using more than one condition in WHERE clause to retrieve records

						SELECT * FROM Cars WHERE BrandName = ‘Mercedes’;	

					This will return two record for the BrandName 'Mercedes'

						SELECT * FROM Cars WHERE BrandName = ‘Mercedes’ AND colour = 'Red';;

					This will return the record for the BrandName 'Mercedes' with a Colour 'Red'. You can use different conditions like AND , OR , < , > in a
					combination or individually in WHERE clause to fetch the desired rows. Try doing it yourself.

				8. Viewing only selected columns from a table

						SELECT BrandName FROM Cars WHERE yearRegisterd > 2013;

					We haven't actually createda yearRegistered column, but if we did, this would return a column of
					BrandNames for cars registerd after 2013

					 	SELECT BrandName , Colour FROM Cars WHERE yearRegisterd > 2013;

					Will return both BrandName and Colour columns, and you can change the sequence of columns

					 	SELECT Colour , BrandName FROM Cars WHERE yearRegisterd > 2013;

				9. Know the structure of table

					In SQlite3 the comand is

						.schema Cars

				10. Checking performance of query

						EXPLAIN QUERY PLAN SELECT * FROM Cars;
			*/

			//View (select or get) all records in from the Cars table
			$sql = 'SELECT * FROM Cars';
			
			//Use PDO query() to query the database with the prepared SQL statement
			$stmt = $this->dbhandle->query($sql);
			
			//Set up an array to return the results to the view
			$result = null;
			
			//Set up a variable to index each row of the array
			$i=0;	
			
			//Use PDO fetchall() the results from the database using a while loop
			//Use a while loop to loop through the rows	
			while ($data = $stmt->fetch()) {
				//Don't worry about this, it's just a simple test to check we can output a value from the database in a while loop
				//echo '</br>' . $data['BrandName'];
			
				//Write the database conetnts to the results array for sending back to the view
				$result[$i]['brandName'] = $data['BrandName'];
				$result[$i]['model'] = $data['Model'];
				$result[$i]['colour'] = $data['Colour'];
				
				//increment the row index
				$i++;
			}		
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
    	
    	//Close the database connection
		$this->dbhandle = NULL;
		
		//Send the response back to the view
		return $result;
	}

//Based on the knowledge gained creating the dbGetData function, and reading the comments therein try and create some iother useful database funcxtions:

public function dbGetOneResult()
	{
		try {		
			//Get the database as an object
			$sql = 'SELECT * FROM Cars';
			$stmt = $this->dbhandle->query($sql);
			
			//Example fetching one result
			$data = $stmt->fetch();
			echo $data['BrandName'];		
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
    	
    	//Close the database connection
		$this->dbhandle = NULL;
	}

	public function dbGetSpecificResult()
	{
		try {					
			//Get the database as an object
			$sql = 'SELECT * FROM Cars';
			$stmt = $this->dbhandle->query($sql);
	
			//Example fetching one particular result
			//First fetch the all data from the object
			$data = $stmt->fetchAll();
			//Then index the database array to find the specific reult you want, the index '3' and the 'Model' could have been inut as parameters
			echo $data[3]['BrandName'] . '</br>' . $data[3]['Model'] . '</br>' . $data[3]['Colour'] ;
	
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
    	
    	//Close the database connection
		$this->dbhandle = NULL;

	}

	public function dbDisplayAllData()
	{
		try {		
			//Get the database as an object
			$sql = 'SELECT * FROM Cars';
			$stmt = $this->dbhandle->query($sql);
			$data = $stmt->fetchAll();
			//All results with a foreach loop
			foreach ($data as $row) {
				echo '</br>' . $row['BrandName'] . ' -- ' . $row['Model'] . ' -- ' . $row['Colour'];	
			}
		
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
    	
    	//Close the database connection
		$this->dbhandle = NULL;
	}

	public function dbDisplayAllDataInTable()
	{
		try {		
			//Get the database as an object
			$sql = 'SELECT * FROM Cars';
			$stmt = $this->dbhandle->query($sql);

			//Read all of the data from the Cars table and print it in an HTML table
   			//First start the HTML table
   			print "<table border=1>";
			print "<tr><td>Id</td><td>Brand</td><td>Model</td><td>Colour</td></tr>";
			
			//Get all the data from the table
			$data = $stmt->fetchall();
			
			//Now print all results to a HTML table with a foreach loop
			foreach($data as $row)
			{
				print "<tr><td>" . $row['Id'] . "</td>"; 
				print "<td>" . $row['BrandName'] . "</td>"; 
	    		print "<td>" . $row['Model'] . "</td>"; 
	   			print "<td>" . $row['Colour'] . "</td></tr>";
    		}
    		
    		//Close the HTML table
			print "</table>";	
		
		}
		catch (PDOEXception $e) {
        	print new Exception($e->getMessage());
    	}
    	
    	//Close the database connection
		$this->dbhandle = NULL;
	}

	public function dbGetCarDetails()
	{		
		$carName = $_GET['carName']; 
		//$carName = 'Mercedes';
		
		/*
			Note: All the echo st aements used for debuging must be commented out once you are sure the code is ok, 
			because the first echo will be returned to the calling view, so in this case the string 'Looking for ...'
			will be returned, which is obvioulsy thenot the JSON packet!
		*/

		//echo 'Looking for model: ' . $carName . '</br></br>';
		
		/*
			Zeeshan's original code:
		
			$dbhandle = sqlite_open('../../db/test1.db'); 	
			if (!$dbhandle) 
				{
					echo "Database ERROR : May be Path to .db file needs checking";
					echo "This file is located at: ".getcwd();
				}
			$result = null;
			$query = sqlite_query($dbhandle, 'SELECT * FROM cars WHERE BrandName = "'. $carName. '"');
			$i = 0;
			while ($row = sqlite_fetch_array($query, SQLITE_ASSOC)) {
				$result[$i]['brandName'] = $row['BrandName'];
				$result[$i]['model'] = $row['Model'];
				$result[$i]['colour'] = $row['Colour'];
				$i++;
			}
			sqlite_close($dbhandle);
			print_r (json_encode($result));
 		*/
 
 		try {		
		/*
			echo 'Making database connection ...</br></br>';
 			//Make a connection to the database
			$this->dbhandle = new PDO('sqlite:./db/test_PDO.db', 'user', 'password', array(
    													PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    													PDO::ATTR_EMULATE_PREPARES => false,
														));

			echo 'Connection to Car database created</br></br>';

			//create a database table
			$this->dbhandle->exec("CREATE TABLE Cars (Id INTEGER PRIMARY KEY, BrandName TEXT, Model TEXT, Colour TEXT)");   
			
			//insert some data...
			$this->dbhandle->exec(
            	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (1, 'Mercedes', 'C220 AMG', 'Black'); " .
            	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (2, 'Mercedes', 'C220 AMG', 'Red'); " .
  	  	    	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (3, 'Toyota', 'Camry', 'White'); " .
	        	"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (4, 'Ford', '2.0 C-max Titanium', 'Silver'); " .
         		"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (5, 'BMW', '3 Series', 'Blue'); " . 
           		"INSERT INTO Cars (Id, BrandName, Model, Colour) VALUES (6, 'Honda', 'Civic i-DTEC diesel', 'Grey');");   

			echo 'Records inserted into Car database</br></br>';

		*/
			//View (select or get) all records in from the Cars table
			$sql = 'SELECT * FROM Cars WHERE BrandName = "'. $carName. '"';
			
			//echo 'Making SQL search on test1.db database: ' . ' [ ' . $sql . ' ] ' . '</br></br>';

			//Use PDO query() to query the database with the prepared SQL statement
			$stmt = $this->dbhandle->query($sql);

			
			
			/*
				Test to check we have read the records from the data base before we pass the result 
				back to the calling function, i.e. View through the Controller. Once you know it is
				working, you can comment it out
			*/
			//echo 'Printing out the records for: ' . $carName . '</br></br>';	
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
			
			/*
				Just another test to check we have read the records from the data base and cast the record into 
				the result array before we pass the result array back to the calling function, i.e. View through the 
				Controller. Once you know it is working, you can comment it out
			*/

			//Use a for loop to output the array contents where the count() function returns the length of the array
			//for ($x =0; $x < count($result); $x++) {
				//echo out the HTML with the array values for testing
			//	echo $result[$x]['brandName'] . ' -- ' . $result[$x]['model'] . ' -- ' . $result[$x]['colour'] . '</br></br>';
			//}
			/*
				Same test as above, I just happened to know the intial database only had two record of interest, 
				but use the above test if you don't know ....
			*/
			//echo $result[0]['brandName'] . ' -- ' . $result[0]['model'] . ' -- ' . $result[0]['colour'] . '</br></br>';
			//echo $result[1]['brandName'] . ' -- ' . $result[1]['model'] . ' -- ' . $result[1]['colour'] . '</br></br>';	
				
		}
		catch (PDOEXception $e) {
        	//echo "I'm sorry, Martin. I'm afraid I can't connect to the database! </br></br>";
        	print new Exception($e->getMessage());
    	}
    	
    	//echo 'Closing the database connection </br></br>';
    	
    	//Close the database connection
		$this->dbhandle = NULL;
		
		//echo 'Database connection is closed</br></br>';
	
		/*
			At this point we need to return our results to the Cotroller, which will in return send the
			result array back to the approriate view by loading that View with the resukt array. The View
			will strip out the records from the array using JQuery, etc.
		
			First test the original view which parses the result array works — same as the dbGetCarDetails method
		*/
		//Send the response back to the view
		//return $result;
		

		/*
			Second, use json_encode to package the result array into a JSON packet and send back to the controller
			The controller will load a new view to display the Car table records return with the servis response
		*/
		//Send the response back to the view
		echo json_encode($result);
	}
}
?>
