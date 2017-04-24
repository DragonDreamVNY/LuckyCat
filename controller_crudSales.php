<?php
//============================
//Start/join a session
//this must come BEFORE the <HTML> tag
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// first check session is set
if( !isset($_SESSION['loggedin']) ){ 
    $_SESSION['loggedin']=FALSE; 
    header("Location:index.php"); 
}

// check if logged in, stops script further executing and bring back to Front page if not logged
if( $_SESSION['loggedin'] == FALSE ) { // LOGGED IN (N)
    header("Location: controller_login_manager.php");
	die("<p><a href =index.php>Click Here to go Home to Log In</a></p>");
}

//includes
include_once("config/connection.php");  //include the database connection 
include_once("config/config.php");  //include the application configuration settings

// views
if($_SESSION['loggedin'] == TRUE){  // LOGGED IN (Y)
	$CTRLmsg='Controller Msg: You are Logged In';
	$userFirstName = $_SESSION['user_FirstName'];
	$userLogInName = $_SESSION['user_LogInName'];
    $userRole = $_SESSION['user_Role'];

    //variables
	$tab="Luck Cat Dashboard";
    include_once("library/helperFunctionsDatabase.php");
    include_once("library/helperFunctionsTables.php");
    include("modules/sales/crudSales.php");
} 
else{ // load the default home with LOG IN form
	$CTRLmsg='Controller Msg: NOT Logged In';
	//not logged in
	include("modules/home/model_home.php"); 
	include("modules/home/view_home.php");
} 

?>