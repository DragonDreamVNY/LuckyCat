<?php
//includes
include("config/connection.php");  //include the database connection 
include("config/config.php");  //include the application configuration settings

//variables
$tab="Lucky Cat Dashboard";

// Registration details sent from Registration Form
if( isset($_POST['btn_register']) ){			
	//process the registration data
	include("library/helperFunctionsDatabase.php");
	include("libary/helperFunctionsTables.php");
	include("modules/register/model_registerResult.php"); 
	include("modules/register/view_registerResult.php");
}
else{ //show the Registration Page
	include("modules/register/model_register.php");
	include("modules/register/view_register.php");
}
?>