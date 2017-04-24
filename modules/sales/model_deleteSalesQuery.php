<?php

//initialise variables
$table='weekly_sales_total';  //table to delete values from
$msg='';  //this is an empty message initially
//$_SESSION['validID']=FALSE; //reset to FALSE 
	
//get the values entered in the form
$salesTransactionID = mysqli_real_escape_string($conn, $_POST['TransactionID']);
$_SESSION['salesTransactionID'] = $salesTransactionID;

//Construct Query strings
$sqlData= "SELECT * FROM $table WHERE TransactionID='$salesTransactionID'";
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
$tab='Lucky Cat Dashboard';
$pageHeading='Delete Sales';

// =====================
// 		NAVIGATION
// =====================
//nav section content - logged in user
// ADMIN or MANAGER
if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='admin') || ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='manager') ) {
	$contentStringNAV= '<div class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
				<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>
				</div>

				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="controller_sales.php">Sales</a></li>
					<li><a href="controller_performance.php">Performance View</a></li>
					<li><a href="controller_charms.php">Lucky Charms</a></li>
				</ul>	
			</div>
		</div>';
}

// ACCOUNTANT
else if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='accountant') ) {
	//nav section content - logged in user
	// $contentStringNAV='<header id="SiteHeader" class = "header">';
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
	$contentStringNAV.= 	'<div class="container">';
	$contentStringNAV.= 		'<div class="navbar-header">';
	$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
	$contentStringNAV.= 	'</div>';

	$contentStringNAV.= 	'<ul class="nav navbar-nav">';
	$contentStringNAV.= 		'<li><a href="index.php">Home</a></li>';
	$contentStringNAV.= 		'<li class="active"><a href="controller_sales.php">Sales</a></li>'; //sales main page
	$contentStringNAV.= 		'<li><a href="controller_performance.php">Performance View</a></li>';
	$contentStringNAV.= 	'</ul>';	
	$contentStringNAV.= 	'</div>';
	$contentStringNAV.= '</div>';
	// $contentStringNAV.= '</header>';

}

else{
	//nav section content - not logged in
	$contentStringNAV='';
	$contentStringNAV.='You Are NOT LOGGED IN boo';
	$contentStringNAV.='<a href="controller_main.php">HOME</a></br>';
}

// =====================
// 		MAIN
// =====================
//main section content:
$contentStringMAIN='';

if($rsData->num_rows==1){//check ONE valid record selected
	$contentStringMAIN='<h3>Confirm this record for DELETION</h3>';
	$_SESSION['validID']=TRUE;
}
else{
	$contentStringMAIN='<h3>The selected record does not exist. </h3>Please select a valid ID.';
	$_SESSION['validID']=FALSE;
}

// =====================
// 		FOOTER
// =====================
$contentStringFOOTER='';
if (__DEBUG==TRUE) //construct the footer with debug information 
	{	
		$contentStringFOOTER.= '<footer class="debug copyright">';

		$contentStringFOOTER.=  '<h3>***DEBUG INFORMATION***</h3>';
		
		$contentStringFOOTER.=  '<h4>$_COOKIE Array</h4>';
		foreach($_COOKIE as $key=>$value){
			$contentStringFOOTER.=  '$_COOKIE[\''.$key."'] = ".$value.'</br>';
		}
		
		$contentStringFOOTER.=  '<h4>$_SESSION Array</h4>';
		foreach($_SESSION as $key=>$value){
			$contentStringFOOTER.=  '$_SESSION[\''.$key."'] = ".$value.'</br>';
		}		

		$contentStringFOOTER.=  '<h4>$_POST Array</h4>';
		foreach($_POST as $key=>$value){
			$contentStringFOOTER.=  '$_POST[\''.$key."'] = ".$value.'</br>';
		}
		
		if(isset($sql)){
			$contentStringFOOTER.=  '<h4>SQL QUERY</h4>';
			$contentStringFOOTER.= $sql;
		}

		$contentStringFOOTER.=  "</footer>";
	}
else{ //construct the standard footer
	// include("inc/footer.php");
	$contentStringFOOTER.='<footer class="copyright">';
	$contentStringFOOTER.= 'Copyright 2017 Vincent Lee';
	$contentStringFOOTER.= "</footer>";
}


?>


















 



