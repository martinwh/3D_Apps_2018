<?php
//Create the controller class for the MVC design pattern
//We can create multiple instances/objects of this controller class
//Each instance or object of this class would hjave its own sepaerate meory space and copys of its members (variables and functions)
class Controller {
	
    //Declare public variables for the controller class, and since they are declared ppublic, they can be accessed anywhere uisng the instance/object of the class
    public $load;
	public $model;
	
    // Create functions for the controller class
    //The first function created for a PHP class is always the contructor function that is executed when the class is initialised
    //So, in this case this constructor will load new objects for the lod and model
    //The it will detrmine which of the following functions we need to access form the $pageURO variable being passed into the constructor
    //The $pageURI value is determined in the mvc.php, which defaults to the home() function if one of the other functions are not specified in the URI.
    //Example 1: http://localhost:8888/3dapp/labs2017/lab7/part_c/my_mvc/index.php will return the testview2 data with the home page function
    //Example 2: http://localhost:8888/3dapp/labs2017/lab7/part_c/my_mvc/index.php/dbgetdata will return the data from the dbGetData model and present it in the dbCarView
	function __construct($pageURI = null)
	{
		//echo $pageURI;
		$this->load = new Load();
		$this->model = new Model();
		// Determine what page you are on
		$this->$pageURI();
	}
    
    // home page function
	function home()
	{
		$data = $this->model->car_info();
		$this->load->view('testview2', $data);
	}
	    
    // Create a table function
    function dbTableDefine()
	{	
		//echo "Create table function";
		$data = $this->model->dbCreateTable();
		$this->load->view('view_simple_message', $data);
	}
	
    // Insert data into the table function
    function dbInsertData()
	{	
		//echo "Data insertion function";
		$data = $this->model->dbInsertData();
		$this->load->view('view_simple_message', $data);
	}
    
    //Get data from the table function
	function dbGetData()
	{	
		//echo "Data retrieval function";
		$data = $this->model->dbGetData();
		$this->load->view('dbCarView', $data);
	}	 
}
?>