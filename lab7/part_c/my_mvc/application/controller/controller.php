<?php
class Controller {
   public $load;
   public $model;
   function __construct($pageURI = null)
   {
	  //echo $pageURI;
      $this->load = new Load();
      $this->model = new Model();
      // determine what page you're on
	  $parameters = isset($_GET['bar']);
	  $parameterPosition = strpos($pageURI,"?");
	  if ($parameterPosition > 0)
	  	{
			$pageURI = substr($pageURI,0,$parameterPosition);
		}
      $this->$pageURI();
   }
   
   //These methods do not use AJAX — they access the database (db) Model class directly
   function home()
   {
      $data = $this->model->car_info();
      $this->load->view('testview2', $data);
   }
   function dbCreateTable()
   {
     // echo "Create table function";
	  $data = $this->model->dbCreateTable();
	  $this->load->view('view_simple_message', $data);
   }
   function dbInsertData()
   {
    $data = $this->model->dbInsertData();
	  $this->load->view('view_simple_message', $data);
   }  
   function dbGetData()
   {
     $data = $this->model->dbGetData();
	 $this->load->view('dbCarView', $data);
   }  
 
   
   //New methods for Part C of Lab 7 Tutorial, which use AJAX
   //Flickr API
   function getFlickrFeed()
   {
	  $this->load->view('getFlickrFeed');
   }
   //These methods uses the JQuery AJAX method .getJSON()
   function readjson()
   {
	  $this->load->view('readjson');
   }
   function loadCarsbyChoice()
   {
	  $data = $this->model->getBrandNames();
	  $this->load->view('loadCarsbyChoice', $data);
   }
     function getCarJson()
   {
      $data = $this->model->getBrandNames();
      $this->load->view('getCarJson', $data);
   } 
   
   
   //These methods do not use AJAX — they access the database (db) Model class directly
   function dbGetOneResult()
   {
     $data = $this->model->dbGetOneResult();
   }
   function dbGetSpecificResult()
   {
     $data = $this->model->dbGetSpecificResult();
   }     
    function dbDisplayAllData()
   {
     $data = $this->model->dbDisplayAllData();
   }   
   function dbDisplayAllDataInTable()
   {
     $data = $this->model->dbDisplayAllDataInTable();
   }
   
   //This method needs updating, I can't remember what it was trying to do?
   function dbCarTypeView()
   {
     $data = $this->model->dbGetData();
	 $this->load->view('dbCarTypeView', $data);
   }

   //Method to insert data in DB uisng the jQuery .ajax() method — the dbInsertionForm.php file needs updating to use PDO for this method.	
   function dbInsertionForm()
   {
	  $this->load->view('dbInsertionForm');
   }  

}
?>