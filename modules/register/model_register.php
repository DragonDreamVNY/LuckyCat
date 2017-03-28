<?php
//prepare view template values
$tab='L03';
$pageHeading='Example 04 - User Registration';

//nav section content
$contentStringNAV='';
$contentStringNAV.='<h3>NAV SECTION</h3>';
$contentStringNAV.='<a href="http://php.net/manual/en/book.mysqli.php">MySQLi Manual</a><br>';
$contentStringNAV.='<h4>Examples</h4>';
$contentStringNAV.='<a href="controller_main.php">HOME</a></br>';

//main section content:
$contentStringMAIN='';

//RHS section content
$contentStringRHS='This example implements form validation and password encryption and checks for password strength.';

//footer section content
$contentStringFOOTER='';


if (__DEBUG==1) //construct the footer with debug information 
	{	
		$contentStringFOOTER.= '<footer class="debug">';

		$contentStringFOOTER.=  '<h3>***DEBUG INFORMATION***</h3>';
		
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


















 



