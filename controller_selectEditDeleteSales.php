<?php
//============================
//Start/join a session
//this must come BEFORE the <HTML> tag
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//initialise session variable used by the controller
if(!isset($_SESSION['salesTransactionID'])){$_SESSION['salesTransactionID']='VALID ID NOT SELECTED';}


//includes
include_once("config/connection.php");  //include the database connection 
include_once("config/config.php");  //include the application configuration settings

//views
if(isset($_POST['editSales_button'])){				
	// load the sales record edit controller
	echo 'Selected for edit...';
	include("controller_editSales_withConfirm.php");
}
elseif( isset($_POST['delSales_button']) ){	
	// load the sales record delete controller
	echo 'Selected for deletion...';
	include("controller_deleteSales.php");
	
}
elseif(isset($_POST['editSales_button'])){
	// load edit sales record controlller
	include("VIEWS/view_ex01_edit_simple_save.php");
}

else{ // defauly back to Sales View
	include("controller_sales.php");
}
?>