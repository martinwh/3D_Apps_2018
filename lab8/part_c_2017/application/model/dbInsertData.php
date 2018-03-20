<?php
	$brandName = $_GET['brandName'];
	$model = $_GET['model'];
	$color = $_GET['color'];
	$dbhandle = sqlite_open('db/test1.db'); 
	if (!$dbhandle) die ($error);

	$ok1 = sqlite_exec($this->dbhandle, "INSERT INTO cars (BrandName, Model, Color) 
								VALUES('$brandName', '$model', '$color' )");
		if (!$ok1) 
			die("Cannot execute statement.");
	sqlite_close($this->dbhandle);
	return "Data successfully inserted ";  
   
?>