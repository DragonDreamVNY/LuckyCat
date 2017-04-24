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
$pageHeading='Lucky Charms Page';

//views
if($_SESSION['loggedin'] == TRUE){  //already logged in
	$CTRLmsg='Controller Msg: You are Logged In';
	$userFirstName = $_SESSION['user_FirstName'];
	$userLogInName = $_SESSION['user_LogInName'];
	$userRole = $_SESSION['user_Role'];

	//echo "Hello $userFirstName.";

	//variables
	$tab="Luck Cat Dashboard";
			
	if( isset($_POST['btn_actionSales']) ){ // insert button pressed, next comes SQL and load InsertSalesResult view			
		if( $_POST['btn_actionSales'] == "INSERT"){
			//process the inserted Sales data
			include("library/helperFunctionsDatabase.php");
			include("library/helperFunctionsTables.php");
			include("modules/luckycharms/model_insertLuckyCharms.php"); 
			include("modules/luckycharms/view_insertLuckyCharms.php");
		}		
		elseif( $_POST['btn_actionSales'] == "EDIT"){
			//process the inserted Sales data
			include("library/helperFunctionsDatabase.php");
			include("library/helperFunctionsTables.php");
			include("modules/luckycharms/model_editLuckyCharms.php"); 
			include("modules/luckycharms/view_editLuckyCharms.php");
		}
	}	
	else{ // load the charms view	
		include("modules/luckycharms/model_luckyCharms.php"); 
		// echo "<p>Lucky model loaded</p>";
		include("modules/luckycharms/view_luckyCharms.php");
	}
} // end if LOGGED IN == TRUE

else{ // load the default home with LOG IN form
	$CTRLmsg='Controller Msg: NOT Logged In';
	//not logged in
	include("modules/home/model_home.php"); 
	include("modules/home/view_home.php");
} 

?>