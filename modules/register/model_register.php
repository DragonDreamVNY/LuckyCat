<?php
// prepare view template values
$tab='Lucky Cat Dashboard';
$pageHeading='User Registration';

//nav section content - not logged in
$contentStringNAV='';
$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
$contentStringNAV.= 	'<div class="container">';
$contentStringNAV.= 		'<div class="navbar-header">';
$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
$contentStringNAV.= 	'</div>';
$contentStringNAV.= 	'<ul class="nav navbar-nav">';
$contentStringNAV.= 		'<li><a href="index.php">Home</a></li>';
$contentStringNAV.= 	'</ul>';	
$contentStringNAV.= 	'</div>';
$contentStringNAV.= '</div>';

// main section content:
// $contentStringMAIN='<h3>Save the World</p>';
// $contentStringMAIN.='<p>find Batman</p>';

// footer section content
$contentStringFOOTER='';

if (__DEBUG==TRUE) //construct the footer with debug information 
{	
		$contentStringFOOTER.= '<footer class="debug">';
		$contentStringFOOTER.= '<div class ="container">';
		$contentStringFOOTER.=  '<h3>***DEBUG INFORMATION***</h3>';
		
		$contentStringFOOTER.=  '<h4>$_POST Array</h4>';
		foreach($_POST as $key=>$value){
			$contentStringFOOTER.=  '$_POST[\''.$key."'] = ".$value.'</br>';
		}
		$contentStringFOOTER.= '</div>';
		$contentStringFOOTER.=  "</footer>";
	}
else{ // construct the standard footer
	$contentStringFOOTER.='<footer class="copyright">';
	$contentStringFOOTER.= 'Copyright 2017 Vincent Lee';
	$contentStringFOOTER.= "</footer>";
}


?>


















 



