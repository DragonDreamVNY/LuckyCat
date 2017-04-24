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
	// process the editSales form table
	include("library/helperFunctionsDatabase.php");
	include("library/helperFunctionsForms.php");
	include("library/helperFunctionsTables.php");
	include("modules/sales/model_editSales.php");
	include("modules/sales/view_editSales.php");
}

elseif(isset($_POST['editSales_SAVE_button'])){
			//process the form data and update sales table
			include("library/helperFunctionsDatabase.php");
			include("library/helperFunctionsTables.php");
			include("modules/sales/model_editSalesCONFIRM.php");
			include("modules/sales/view_editSalesCONFIRM.php.php");
}

elseif( isset($_POST['delSales_button']) ){	
	// load the sales record delete controller
	include("controller_deleteSales.php");
	echo 'Selected for deletion...';
}


else{ // default back to Sales View
	include("controller_sales.php");
}
?>