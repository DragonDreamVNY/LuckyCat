<?php
//includes
include_once("CONFIG/config.php");  //include the application configuration settings

//Start/join a session
session_start();  //this must come BEFORE the <HTML> tag

//initialise session variable used by controller
if(!isset($_SESSION['loggedin'])){$_SESSION['loggedin']=0;}
if(!isset($_SESSION['loginAttempts'])){$_SESSION['loginAttempts']=0;}
if(!isset($_SESSION['views'])){$_SESSION['views']=0;}

//main controller functionality:
if (isset($_POST["selectController"])){  //process the selected option
	switch ($_POST["selection"]){
		case 'ex1':  //register a user - no encryption or validation
		include('controller_Ex01_register.php');
		break;

		case 'ex2':  //register a user - with encryption but no validation
		include('controller_Ex02_register.php');
		break;
	
		case 'ex3': //register a user - with encryption and form validation
		include('controller_Ex03_register.php');
		break;
		
		case 'ex4': //register a user - check password strength
		include('controller_Ex04_register.php');
		break;
		
		case 'ex5': //user login - with encrypted password in DB
		include('controller_login_manager.php');
		break;

		default:  //show the main public page
		include("MODELS/model_home.php");
		include("VIEWS/view_home.php");		
	}
}
else{  //no selection has been made yet
	include("MODELS/model_home.php"); 
	include("VIEWS/view_home.php");
}

?>