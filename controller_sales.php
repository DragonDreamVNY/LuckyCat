<?php

include("config/config.php");  //include the application configuration settings

//============================
//Start/join a session
//this must come BEFORE the <HTML> tag

session_start();

if (!isset($_SESSION['loggedin'])){
    header("Location: controller_login_manager.php");
	die("<p><a href =index.php>Click to go Home</a></p>");
}

//initialise session variable used by controller
if( !isset($_SESSION['loggedin']) ){ $_SESSION['loggedin']=FALSE; }
if( !isset($_SESSION['loginAttempts']) ){ $_SESSION['loginAttempts']=0; }
if( !isset($_SESSION['views'])){$_SESSION['views']=0; }

if($_SESSION['loggedin'] == TRUE){  //already logged in
	$msg='Controller Msg: You are Logged In';
	$userFirstName = $_SESSION['user_FirstName'];
	//echo "Hello $userFirstName.";

	//variables
	$tab="Luck Cat Dashboard";
			
	include("modules/sales/model_Sales.php"); 
	//echo "<p>model loaded</p>";
	include("modules/sales/view_Sales.php");
	//echo "<p>view loaded</p>";
}
else{
	$msg='Controller Msg: NOT Logged In';
	//not logged in
	include("modules/home/model_home.php"); 
	include("modules/home/view_home.php");
}


?>