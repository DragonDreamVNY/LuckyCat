<?php
//============================
//Start/join a session
//this must come BEFORE the <HTML> tag
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//initialise session variable used by the controller
if( !isset($_SESSION['loggedin']) ){ $_SESSION['loggedin']=FALSE; }

// check if logged in, stops script further executing and bring back to Front page if not logged
if( $_SESSION['loggedin'] == FALSE ) {
    header("Location: controller_login_manager.php");
	die("<p><a href =index.php>Click Here to go Home to Log In</a></p>");
}

//includes
include_once("config/connection.php");  //include the database connection 
include_once("config/config.php");  //include the application configuration settings

//variables
$tab="Lucky Cat Dashboard";
$pageHeading='Insert Sales Page';

//views
if($_SESSION['loggedin'] == TRUE){  //already logged in
	$CTRLmsg='Controller Msg: You are Logged In';
	$userFirstName = $_SESSION['user_FirstName'];
	$userLogInName = $_SESSION['user_LogInName'];
	//echo "Hello $userFirstName.";

	//variables
	$tab="Luck Cat Dashboard";
			
	if( isset($_POST['btn_insertSales']) ){ // insert button pressed, next comes SQL and load InsertSalesResult view			
		//process the inserted Sales data
		include("library/helperFunctionsDatabase.php");
		include("library/helperFunctionsTables.php");
		include("modules/sales/model_insertSalesRESULT.php"); 
		include("modules/sales/view_insertSalesRESULT.php");		
	}	
	else{ // load the insertSales form	
		include("modules/sales/model_insertSales.php"); 
		//echo "<p>insert Sales model loaded</p>";
		include("modules/sales/view_insertSales.php");
	}
} // end if LOGGED IN == TRUE

else{ // load the default home with LOG IN form
	$CTRLmsg='Controller Msg: NOT Logged In';
	//not logged in
	include("modules/home/model_home.php"); 
	include("modules/home/view_home.php");
} 

?>