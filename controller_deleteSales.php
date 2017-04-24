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

if( isset($_POST['delSales_button']) ){
	echo 'are you sure you want to delete? load the DeleteConfirm Buttons.';
	include("modules/sales/model_deleteSales.php");
	include("modules/sales/views_deleteSales.php");
}

elseif( isset($_POST['delSalesConfirm_button']) ){
	echo 'no going back now. DELETE!';
	//process the form data
	include("library/helperFunctionsDatabase.php");
	include("library/helperFunctionsTables.php");
	include("modules/sales/model_confirmDeleteSales.php");
	include("modules/sales/view_confirmDeleteSales.php");
}
elseif( isset($_POST['doNotDelete_button'] ) ){
	// don't delete!
	echo 'DONT DELETE, going back to the Sales View';
	include("modules/sales/model_insertSales.php");
	include("modules/sales/views_insertSales.php");
}
else{ //none of these delete related buttons were pressed? 
	echo 'Oh? Back to the Sales View...';
	include("modules/sales/model_insertSales.php");
	include("modules/sales/views_insertSales.php");

}
?>