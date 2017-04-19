<?php
//============================
//Start/join a session
//this must come BEFORE the <HTML> tag
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//initialise session variable used by the controller
if(!isset($_SESSION['studentID'])){$_SESSION['studentID']='VALID ID NOT SELECTED';}


//includes
include_once("config/connection.php");  //include the database connection 
include_once("config/config.php");  //include the application configuration settings

//variables
$tab="Edit Sales";


//views
if(isset($_POST['btn_edit'])){				
	//process the form data
	include("library/helperFunctionsDatabase.php");
	include("library/helperFunctionsForms.php");
	include("library/helperFunctionsTables.php");
	include("modules/sales/model_editSales.php");
	include("modules/sales/views_editSales.php");
}			
elseif(isset($_POST['btn_save'])){
			//process the form data
			include("LIBRARY/helperFunctionsDatabase.php");
			include("LIBRARY/helperFunctionsTables.php");
			include("MODELS/model_ex01_edit_simple_save.php");
			include("VIEWS/view_ex01_edit_simple_save.php");
}
else{
			include("MODELS/model_ex01_edit_simple.php");
			include("VIEWS/view_ex01_edit_simple.php");
}
?>