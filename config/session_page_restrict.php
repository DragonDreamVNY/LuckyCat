<?php
session_start();
if(!($_SESSION['loggedin']==1)){//not logged in redirect to home page
	header("Location: ../controller_main.php"); /* Redirect browser */
	/* Make sure that code below does not get executed when we redirect. */
	exit;
	
	}
else{//already logged in - redirect to logged in home page - no time delay
	header("Location: ../modules/login/controller_login_manager.php"); /* Redirect browser */
	/* Make sure that code below does not get executed when we redirect. */
	exit;
}	
?>