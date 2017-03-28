<?php
//includes
include_once("CONFIG/config.php");  //include the application configuration settings
include_once("CONFIG/connection.php"); //include the database connection

//Start/join a session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//initialise session variable used by controller
if(!isset($_SESSION['loggedin'])){$_SESSION['loggedin']=0;}
if(!isset($_SESSION['loginAttempts'])){$_SESSION['loginAttempts']=0;}
if(!isset($_SESSION['views'])){$_SESSION['views']=0;}

//get the maximum number of login attempts from the CONFIG file
$attemptsMax=__LOGIN_ATTEMPT_MAX;  //this will be used to limit the number of login attempts

//set up a session variable to count the page views if the user loggedin variable is set
if($_SESSION['loggedin']==1){  //already logged in
	$msg='Controller Msg: Already Logged In';
	if(isset($_SESSION['views']))
		$_SESSION['views']++;
	else
		$_SESSION['views'] = 1;
}
else{
	$msg='Controller Msg: NOT Logged In';
}

//process logout
if(isset($_POST['logout1'])){//Logout Method 1: has the logout1 button been pressed
	if(isset($_SESSION['loggedin'])) unset($_SESSION['loggedin']);
	$msg="Logout Method 1 - Kills a specific session variable (‘loggedin’). Other session variable ('views') remains available. The session is not destroyed.The client machine cookie in which the session ID is stored is not killed.";
}

if(isset($_POST['logout2'])){//Logout Method 2: has the logout2 button been pressed
	session_destroy();  
	/*
	*	session_destroy() 
	*	destroys all of the data associated with the current session. 
	*	It does not unset any of the global variables associated with the session, 
	*	or unset the session cookie. To use the session variables again, 
	*	session_start() has to be called
	*/
	$msg="Logout Method 2 - Kills ALL the session variables.Kills the session.Does not kill the session ID COOKIE on the client machine.";
}

if(isset($_POST['logout3'])){//Logout Method 3: has the logout3 button been pressed
	// Unset all of the session variables.
	$_SESSION = array();
	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]);
	}
	session_destroy();
	$msg="Logged Out Successfully";


        include("controller_main.php"); 
        exit(0);
	
	
	}

//process login
if(isset($_POST['login'])){//Has the login button been pressed
	//check the login credentials are valid
	//get the form values entered
	$userID=$_POST['lectID'];
	$userPW=$_POST['lectPass'];
	$passEncrypt= hash('ripemd160', $userPW);  //encrypt the password 	

	//construct the SQL query  (UNCOMMENT THE SQL AS APPROPRIATE)
	//$sql= "SELECT * FROM lecturer WHERE LectID='$userID' AND password='$userPW'";  //password is not encrypted in DB
	$sql= "SELECT * FROM lecturer WHERE LectID='$userID' AND password='$passEncrypt'"; //password is encrypted in DB
	$msg=$sql;
	
	//execute the query
	$rs=$conn->query($sql);  //execute the query
	
	//check the login credentials
	if($rs->num_rows==1) //process the login credentials
		{  //login is successful
			$_SESSION['loggedin']=1;
			$rs->data_seek(0);  //point to the current row
			$row = $rs->fetch_assoc();  //get the data in the row
			
			//put the logged in user data into the $_SESSION array
			$_SESSION['firstName']=$row['FirstName'];
			$_SESSION['lastName']=$row['LastName'];
			
			//user is now logged in
			$msg='<h3>Controller Message: Logged in Successfully<h3>';
			$msg.='Welcome '.$_SESSION['firstName'].' '. $_SESSION['lastName'].' You are now logged in';
			
			//redirect to the logged in user home page voa the login controller
			echo '<meta http-equiv="Refresh" content="0;url=controller_login_manager.php" />';
			
			//header("Location:controller_login_manager.php"); /* Redirect browser */
			//exit;

	} //end login successful section
	else{   //login is not successful	
		$_SESSION['loginAttempts']++;  //increment the current count of the number of login attempts in the $_SESSION variable
		$remainingLogins=$attemptsMax-$_SESSION['loginAttempts'];
		$msg= "<h3>Login Attempt has Failed </h3>";	
		$msg.='<p>Login FAIL using : '.$sql;
		$msg.='<p>Nr Rows='.$rs->num_rows;
		$msg.="<p> You are limited to $attemptsMax login attempts - you have $remainingLogins remaining";	
		
		if ($_SESSION['loginAttempts']>=$attemptsMax)  //check that the login attempts dont exceed limit
			{  //redirect if login limit exceeded
			$msg.= "<h3>Unauthorised Access Prohibited</h3>";
			$msg.= "You have exceeded the permitted number of login attempts. Your account will be disabled. ";
			$title='Login Blocked';
			$pageHeading="Ex03 - Login Blocked";
			include("VIEWS/view_ex05_blocked.php");
			//
			
			//
			// If required - insert code here to lock the account
			//
			}
			else{
				//login was unsuccessful - try again
				include("MODELS/model_ex05.php"); 
				include("VIEWS/view_home.php");
			}
			

	}
}
else{ //login button has not been pressed 
	if($_SESSION['loggedin']==1){ //user is already logged in
		//DISPLAY the logged in user home page
		include("MODELS/model_ex05.php"); 
		include("VIEWS/view_home.php");
	}
	else{//not logged in
		$remainingLogins=$attemptsMax-$_SESSION['loginAttempts'];  //check number of remaining attempts
		if ($remainingLogins>0){
			//login button is not pressed and still some attempts remaining redirect to login
			include("MODELS/model_ex05.php"); 
			include("VIEWS/view_home.php");	
		}
		else{
			//number of login attempts exceeded show blocked page
			$title='Login Blocked';
			$pageHeading="Ex05 - Login Blocked";
			include("VIEWS/view_ex05_blocked.php");
			
		}
		
	}
}

?>