<?php

$table='lecturer';  //table to insert values into
	
//INSERT QUERY
//get the values entered in the form
$lectID=$conn->real_escape_string($_POST['lectID']);
$lectFirstName=$conn->real_escape_string($_POST['lectFirstName']);
$lectLastName=$conn->real_escape_string($_POST['lectLastName']);
$pass1=$_POST['lectPass1'];
$pass2=$_POST['lectPass2'];		

$msg='';  //this is an empty message initially , it will contain the result of the insertion
	
if ($pass1===$pass2)
	{
		//HASHING the PASSWORD
		
		//this hashing function is available in PHP 5.5 + only
		//$options = ['cost' => 12,];
		//echo password_hash("datadrivenapplications", PASSWORD_BCRYPT, $options)."\n";
		//$passEncrypt=password_hash($pass1,PASSWORD_DEFAULT);  
		//see PHP manual  http://php.net/manual/en/function.password-hash.php

		//this hashing method works in PHP 5.1.2. +
		//the first parameter is the hash algorithm
		$passEncrypt= hash('ripemd160', $pass1);  //this algorithm requires 40 chars field length
		
		//construct the SQL
		$sqlInsert= "INSERT INTO $table (LectID,FirstName,LastName,password) VALUES('$lectID','$lectFirstName','$lectLastName','$passEncrypt')";

		
		if(query($conn,$sqlInsert)==1) //execute the INSERT query
		{ 
		$msg.= "<h3>New data inserted successfully</h3>";
		
		}
		else
		{
		$msg.=  "<h3>New data has not been inserted - a record for this ID already exists</h3>";
		}
		
	}
	else
	{ 
		$msg.= "<h3>Passwords don't match - data not entered</h3>";
	}
				
			
//prepare the result of the insertion for display in a view

//Query string
$sqlData="SELECT * FROM $table WHERE LectID='$lectID'";  //get the data from the table
$sqlTitles="SHOW COLUMNS FROM $table";  //get the table column descriptions

//execute the 2 queries
$rsData=getTableData($conn,$sqlData);
$rsTitles=getTableData($conn,$sqlTitles);

//check the results 
$arrayData=checkResultSet($rsData);
$arrayTitles=checkResultSet($rsTitles);

//close the connection
$conn->close();


//-----------------------------------------------------
//prepare view template values
$tab='L03';
$pageHeading='Example 03 - User Registration';

//nav section content
$contentStringNAV='';
$contentStringNAV.='<h3>NAV SECTION</h3>';
$contentStringNAV.='<a href="http://php.net/manual/en/book.mysqli.php">MySQLi Manual</a><br>';
$contentStringNAV.='<h4>Examples</h4>';
$contentStringNAV.='<a href="controller_main.php">HOME</a></br>';

//main section content:
$contentStringMAIN=$msg;


//RHS section content
$contentStringRHS='This example is a simple user registration.It does not involve any form of form validation and password strength checking. Also, the password is not encrypted when saved in the database.';

//footer section content
$contentStringFOOTER='';


if (__DEBUG==1) //construct the footer with debug information 
	{	
		$contentStringFOOTER.= '<footer class="debug">';

		$contentStringFOOTER.=  '<h3>***DEBUG INFORMATION***</h3>';
		
		$contentStringFOOTER.=  '<h4>SQL</h4>';
		$contentStringFOOTER.=  $sql;

		
		$contentStringFOOTER.=  '<h4>$_POST Array</h4>';
		foreach($_POST as $key=>$value){
			$contentStringFOOTER.=  '$_POST[\''.$key."'] = ".$value.'</br>';
		}
		
		
		$contentStringFOOTER.=  "</footer>";
	}
else{ //construct the standard footer
	$contentStringFOOTER.='<footer class="copyright">';
	$contentStringFOOTER.= 'Copyright 2017 Gerry Guinane';
	$contentStringFOOTER.= "</footer>";
}


?>


















 



