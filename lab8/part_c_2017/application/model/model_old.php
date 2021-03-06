<?php
class Model {
	public $dbhandle;
   function __construct()
   {
	  $this->dbhandle = sqlite_open('db/test1.db'); 
   }
   public function car_info()
   {
      // simulate real data
      return array(
         'car1' 	=>'Mercedes',
         'car2'		=>'Toyota',
		 'car3' 	=> 'Ford',
         'car4' 	=> 'BMW',
		 'car5' 	=> 'Honda'
      );
   }
   public function dbCreateTable()
   {
	if (!$this->dbhandle) die ($error);
	$stm = "CREATE TABLE cars(Id int AUTO_INCREMENT, BrandName text NOT NULL, Model text, Color text)";
	$ok = sqlite_exec($this->dbhandle, $stm, $error);
	if (!$ok)
	   die("Cannot execute query. $error");
	sqlite_close($this->dbhandle);
	echo "<br> ".!$ok. "<br> ";
	return "A Table named cars is successfully created inside Test1.db file";
   }
   public function dbInsertData()
   {
	$brandName = array ('Mercedes', 'Toyota', 'Ford', 'BMW', 'Honda'); 
	$model = array ('C63 MG', 'Camry', '2.0 C-max Titanium', 'X5 M', 'Civic i-DTEC Diesel'); 
	$color = array ('Black', 'White', 'Silver', 'Blue', 'Grey'); 
	
	if (!$this->dbhandle) die ($error);

	for ($i = 0; $i <count ($brandName); $i++)
	{
		$ok1 = sqlite_exec($this->dbhandle, "INSERT INTO cars (BrandName, Model, Color) 
								VALUES('$brandName[$i]', '$model[$i]', '$color[$i]' )");
		if (!$ok1) 
			die("Cannot execute statement.");
	}
	sqlite_close($this->dbhandle);
	return "Data successfully inserted ";
   }
      
   public function dbGetData()
   {
	if (!$this->dbhandle) die ($error);
	$result = null;
	$query = sqlite_query($this->dbhandle, 'SELECT * FROM cars');
	$i = 0;
	while ($row = sqlite_fetch_array($query, SQLITE_ASSOC)) {
		$result[$i]['brandName'] = $row['BrandName'];
		$result[$i]['model'] = $row['Model'];
		$result[$i]['color'] = $row['Color'];
		$i++;
	}
	sqlite_close($this->dbhandle);   
	return $result;
   }
   
}
?>