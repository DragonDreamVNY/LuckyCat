<?php
//============================
//Start/join a session
//this must come BEFORE the <HTML> tag
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


//initialise session variable used by the controller
if(!isset($_SESSION['sales_TransactionID'])){ $_SESSION['sales_TransactionID']='VALID ID NOT SELECTED'; }


//includes
include_once("config/connection.php");  //include the database connection 
include_once("config/config.php");  //include the application configuration settings

//variables
$tab="Delete Sales";

//views
if( isset($_POST['btn_select_for_deletion']) ){	
	//process the form data
	include("library/helperFunctionsDatabase.php");
	include("library/helperFunctionsForms.php");
	include("library/helperFunctionsTables.php");
	include("modules/sales/model_deleteSales.php");
	include("modules/sales/view_deleteSales.php");
	echo 'Selected deletion...';
}
			
elseif( isset($_POST['btn_confirm_delete']) ){
	//process the form data
	include("library/helperFunctionsDatabase.php");
	include("library/helperFunctionsTables.php");
	include("modules/sales/model_confirmDeleteSales.php");
	include("modules/sales/view_confirmDeleteSales.php");
	echo 'OK DELETE THIS...';

}
else{
	echo 'Oh? Back to the Sales View...';
	include("modules/sales/model_updateSales.php");
	include("modules/sales/views_updateSales.php");

}
?>