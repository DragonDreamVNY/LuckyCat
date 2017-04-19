<?php

//initialise variables
$table='students';  //table to delete values from
$msg='';  //this is an empty message initially
//$_SESSION['validID']=FALSE; //reset to FALSE 
	
//get the values entered in the form
$studID=$conn->real_escape_string($_POST['studID']);
$_SESSION['studentID']=$studID;

//Construct Query strings
$sqlData= "SELECT * FROM $table WHERE StudentID='$studID'";
$sqlTitles="SHOW COLUMNS FROM $table";  //get the table column descriptions
// could put in session variable here to track if deletion was successful or not
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
$tab='L05';
$pageHeading='Example 02 - Delete Student Record (simple)';

//nav section content
$contentStringNAV='';
$contentStringNAV.='<h3>NAV SECTION</h3>';
$contentStringNAV.='<a href="http://php.net/manual/en/book.mysqli.php">MySQLi Manual</a><br>';
$contentStringNAV.='<h4>Examples</h4>';
$contentStringNAV.='<a href="controller_main.php">HOME</a></br>';

//main section content:

if($rsData->num_rows==1){//check ONE valid record selected
	$contentStringMAIN='<h3>Confirm this record for DELETION</h3>';
	$_SESSION['validID']=TRUE;
}
else{
	$contentStringMAIN='<h3>The selected record does not exist. </h3>Please select a valid ID.';
	$_SESSION['validID']=FALSE;
}

//RHS section content
$contentStringRHS='This page displays the status of the delete record process.';

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
	$contentStringFOOTER.= 'Copyright 2017 Vincent Lee';
	$contentStringFOOTER.= "</footer>";
}


?>


















 



