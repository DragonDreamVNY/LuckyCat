<?php
//============================
//Start/join a session
//this must come BEFORE the <HTML> tag
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//initialise variables
$table='sales';  //table to insert values into
$msg='';  //this is an empty message initially , it will contain the result of the insertion
	
//get the value entered in the form
$transactionID=$conn->real_escape_string($_POST['sales_TransactionID']);

//Construct Query 
$sqlData= "SELECT * FROM $table WHERE sales_TransactionID='$transactionID'";

//execute the query
$rsData=getTableData($conn,$sqlData);

//check if the id entered is valid
if($rsData->num_rows==1){
	$rsData->data_seek(0); //point to first row of resultset object returned from query
	$row = $rsData->fetch_assoc();
	$_SESSION['transactionID']=$transactionID;	
	$_SESSION['date']=$row['date'];
	$_SESSION['dineSales']=$row['dine_Sales'];	
	$_SESSION['takeSales']=$row['take_Sales'];		
	$_SESSION['deliverSales']=$row['deliver_Sales'];		
	$_SESSION['validID']=TRUE;	//set a session vaiable to track whether valid ID is entered
	$msg.='Valid TransactionID received';
}
else
{
	$_SESSION['validID']=FALSE;	
	$msg.='TransactionID is NOT valid';
}
			
//close the connection
$conn->close();


//-----------------------------------------------------
//prepare view template values
$tab='Edit Sales';
$pageHeading='Edit Sales Data';

//nav section content
$contentStringNAV='';
$contentStringNAV.='<h3>NAV SECTION</h3>';
$contentStringNAV.='<a href="http://php.net/manual/en/book.mysqli.php">MySQLi Manual</a><br>';
$contentStringNAV.='<h4>Examples</h4>';
$contentStringNAV.='<a href="controller_main.php">HOME</a></br>';

//main section content:
$contentStringMAIN='<h3>'.$msg.'</h3>';


//RHS section content
$contentStringRHS='This example presents a form for editing a student’s details.
The form allows a specific student to be selected by entering their ID number (K0xxxxxx)
A valid ID must be entered
On submission – the students record is presented with all fields available for editing – except for the StudentID
';

//footer section content
$contentStringFOOTER='';


if (__DEBUG==1) //construct the footer with debug information 
	{	
		$contentStringFOOTER.= '<footer class="debug">';

		$contentStringFOOTER.=  '<h3>***DEBUG INFORMATION***</h3>';
		
		$contentStringFOOTER.=  '<h4>SQL</h4>';
		$contentStringFOOTER.=  $sqlData;	


		
		$contentStringFOOTER.=  '<h4>$_POST Array</h4>';
		foreach($_POST as $key=>$value){
			$contentStringFOOTER.=  '$_POST[\''.$key."'] = ".$value.'</br>';
		}
		
		$contentStringFOOTER.=  '<h4>$_SESSION Array</h4>';
		foreach($_SESSION as $key=>$value){
			$contentStringFOOTER.=  '$_SESSION[\''.$key."'] = ".$value.'</br>';
		}
		
		$contentStringFOOTER.=  "</footer>";
	}
else{ //construct the standard footer
	$contentStringFOOTER.='<footer class="copyright">';
	$contentStringFOOTER.= 'Copyright 2017 Gerry Guinane';
	$contentStringFOOTER.= "</footer>";
}


?>


















 



