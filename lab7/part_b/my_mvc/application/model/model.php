<?php
class Model {

    public $dbhandle;
	
	public function __construct()
	{
		try {	
			//Change connection string for different databases, currently using SQLite
			$this->dbhandle = new PDO('sqlite:./db/test1.db', 'user', 'password', array(
    													PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    													PDO::ATTR_EMULATE_PREPARES => false,
														));
														
														
		}
		catch (PD0EXception $e) {
			print new Exception($e->getMessage());
		}
	}
	
	public function dbCreateTable()
	{
		try {
			$this->dbhandle->exec("CREATE TABLE CARS (Id INTEGER PRIMARY KEY, BrandName TEXT, Model TEXT, Colour TEXT)");
			return "A table named cars is successfully created inside Test1.db file";
		}
		catch (PD0EXception $e){
			print new Exception($e->getMessage());
		}
		$this->dbhandle = NULL;
	}
	
	public function dbInsertData()
	{
		try{
			$this->dbhandle->exec("INSERT INTO CARS (Id, BrandName, Model, Colour) VALUES (1, 'Mercedes', 'C220 AMG', 'Black'); " .
			"INSERT INTO CARS (Id, BrandName, Model, Colour) VALUES (2, 'Toyota', 'Camry', 'White'); " .
			"INSERT INTO CARS (Id, BrandName, Model, Colour) VALUES (3, 'Ford', '2.0 C-max Titanium', 'Silver'); " .
			"INSERT INTO CARS (Id, BrandName, Model, Colour) VALUES (4, 'BMW', '3 Series', 'Blue'); " .
			"INSERT INTO CARS (Id, BrandName, Model, Colour) VALUES (5, 'Honda', 'Civic i-DTEC diesel', 'Grey'); ");
			return "Data inserted successfully inside Test1.db file";
		}
		catch(PD0EXception $e) {
			print new Exception($e->getMessage());
		}
		$this->dbhandle = NULL;
	}
	
	public function dbGetData(){
		try{
			
			$sql = 'SELECT * FROM Cars';
			$stmt = $this->dbhandle->query($sql);
			
			
			$result = null;
			
			
			$i=-0;
			
			while ($data = $stmt->fetch()) {
				
				$result[$i]['brandName'] = $data['BrandName'];
				$result[$i]['model'] = $data['Model'];
				$result[$i]['colour'] = $data['Colour'];
				
				$i++;
			}
		}
		catch (PD0EXception $e) {
			print new Exception($e->getMessage());
		}
	
	
	$this->dbhandle = NULL;
	
	return $result;
}
}
?>
				
				
	
			
		
