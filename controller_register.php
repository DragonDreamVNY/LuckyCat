<?php
//includes
include("config/connection.php");  //include the database connection 
include("config/config.php");  //include the application configuration settings

//variables
$tab="L03";

//views
if(isset($_POST['btn_register'])){			
			//process the registration data
			include("library/helperFunctionsDatabase.php");
			include("libary/helperFunctionsTables.php");
			include("modules/register/result.php"); 
			include("modules/register/view_register_result.php");
			
		}
else{
			include("modules/register/result.php");
			include("modules/view_register.php");
}
?>