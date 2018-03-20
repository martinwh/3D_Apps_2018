<?php
// Create the controller class for the MVC design pattern
class Controller {

	// Declare public variables for the controller class
	public $load;
	public $model;
	
	// Create functions for the controller class
	function __construct($pageURI = null)
	{
		// echo $pageURI;
		$this->load = new Load();
		$this->model = new Model();
		// Determine what page you are on
		$this->$pageURI();
	}
    // home page function
	function home()
	{
		$data = $this->model->model3D_info();
		$this->load->view('view3DAppTest_2', $data);
	}
	function apiCreateTable()
	{
	  	// echo "Create table function";
		$data = $this->model->dbCreateTable();
		$this->load->view('viewMessage', $data);
	}
	function apiInsertData()
	{
		$data = $this->model->dbInsertData();
	   	$this->load->view('viewMessage', $data);
	}  
	function apiGetData()
	{
		$data = $this->model->dbGetData();
		$this->load->view('view3DAppData', $data);
	}  	
	
	//New methods for Part C of Lab 7 Tutorial, which use AJAX
	//Flickr API
	function getFlickrFeed()
	{
		$this->load->view('getFlickrFeed');
	}
	

	
}
?>    