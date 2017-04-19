<?php

//initialise variables
$table='students';  //table to insert values into
$msg='';  //this is an empty message initially , it will contain the result of the insertion

	
//get the values entered in the form
$studID=$_SESSION['studentID'];

//Construct Query strings
$sqlDelete= "DELETE FROM $table WHERE StudentID='$studID'";


if(query($conn,$sqlDelete)==1){
	$msg='Record successfully deleted';
}
else{
		$msg='Unable to delete record';
}

			
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
$contentStringMAIN='<h3>'.$msg.'</h3>';


//footer section content
$contentStringFOOTER='';


if (__DEBUG==1) //construct the footer with debug information 
	{	
		$contentStringFOOTER.= '<footer class="debug copyright">';

		$contentStringFOOTER.=  '<h3>***DEBUG INFORMATION***</h3>';
		
		$contentStringFOOTER.=  '<h4>SQL</h4>';
		$contentStringFOOTER.=  $sqlDelete;	


		
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


















 



