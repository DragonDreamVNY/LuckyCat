<?php

//Define Connection Parameters
$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBUser   = 'root';
$DBPass   = 'root';
$DBName   = 'luckycat';

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);  //-->mysqli::__construct — Open a new connection to the MySQL server
//$conn = mysqli_connect("localhost", "root", "root", "luckycat");  


// check connection
if ( $conn->connect_error ) { 
	if (__DEBUG==TRUE) {
		echo "<p>Database connection failed: $conn->connect_error, E_USER_ERROR </p>";
	}
	else{
		header("Location: error.php"); /* Redirect browser */
		/* Make sure that code below does not get executed when we redirect. */
		exit;
	}
	exit("<p>PHP script terminated. Database connection failed</p>");
} else{
    if($conn){ //database connect successful
        if (__DEBUG==TRUE) {
            echo "<p>Database Connected</p>";
            print_r($conn);
        }
    }
}
?>