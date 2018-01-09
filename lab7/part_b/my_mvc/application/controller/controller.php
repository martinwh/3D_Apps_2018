<?php
//Create the controller class for the MVC design pattern
class Controller {
	public $load;
	public $model;
	// Create functions for the controller class
	function __construct($pageURI = null)
	{
		//echo $pageURI;
		$this->load = new Load();
		$this->model = new Model();
		// Determine what page you are on
		$this->$pageURI();
	}
	function home()
	// home page function
	{
		$data = $this->model->car_info();
		$this->load->view('testview2', $data);
	}
	function dbBuildTable()
	{	
		//echo "Create table function";
		$data = $this->model->dbCreateTable();
		$this->load->view('view_simple_message', $data);
	}
	function dbInsertData()
	{	
		//echo "Data insertion function";
		$data = $this->model->dbInsertData();
		$this->load->view('view_simple_message', $data);
	}
	function dbGetData()
	{	
		//echo "Data retrieval function";
		$data = $this->model->dbGetData();
		$this->load->view('dbCarView', $data);
	}	 
}
?>