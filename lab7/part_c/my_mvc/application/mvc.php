<?php
require 'view/load.php';
require 'model/model.php';
require 'controller/controller.php';
$pageURI = $_SERVER["REQUEST_URI"];
$indexPos = strrpos($pageURI,"index.php");
if ($indexPos)
	{
	$pageURI = substr($pageURI,$indexPos+10);
	if ($pageURI)
		new Controller($pageURI); 
	else
		new Controller("home");
	}
	else
	{
	  new Controller("home");  
	}
?>