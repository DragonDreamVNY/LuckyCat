<?php
/*
// =====================
// Load INSERT or EDIT/DELETE to view if LoggedIn, else show the LogIn form
// =====================
*/
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//initialise session variables
if(!isset($_SESSION['loggedin'])){$_SESSION['loggedin']=FALSE;}
if(!isset($_SESSION['loginAttempts'])){$_SESSION['loginAttempts']=0;}
if(!isset($_SESSION['views'])){$_SESSION['views']=0;}

// $_SESSION['loggedin']=TRUE; //logged In

include_once("config/connection.php");  //include the database connection 
include_once("config/config.php");  //include the application configuration settings

// if ( $conn->connect_error ) { 
// 	if (__DEBUG==TRUE) {
// 		echo "<p>Database connection failed: $conn->connect_error, E_USER_ERROR </p>";
// 	}
// 	else{
// 		header("Location: error.php"); /* Redirect browser */
// 		/* Make sure that code below does not get executed when we redirect. */
// 		exit;
// 	}
// 	exit("<p>PHP script terminated. Database connection failed</p>");
// } else{
//     if($conn){ //database connect successful
//         if (__DEBUG==TRUE) {
//             echo "<h3>Database Connected in insertSales</h3>";
//         }
//     }
// }

//prepare view template values
$tab='Lucky Cat Dashboard';
$pageHeading='Sales Page';

//initialise variables
$table='sales';  //table to insert values into
$msg='';  //this is an empty message initially , it will contain the result of the insertion

// =====================
// DATABASE QUERIES
// =====================
$outputTable = '';
 
$sqlViewQuery = "SELECT * FROM weekly_sales_total";

//=====================
// execute the SALES VIEW and populate Table
if( mysqli_query($conn,$sqlViewQuery)==TRUE ) { // table query success
	$msg .= "<h2>Sales Data</h2>";
	$result = mysqli_query($conn,$sqlViewQuery); // store View in result variable
	// construct the table headers
	if(__DEBUG == TRUE){
		echo "<br/>";
		echo "<h4>MySQLi result Array:</h4>";
		print_r($result);
	}

	//(3) HTML Table is created filled with data sent to "resultsTable" placeholder
	$outputTable .= '
		<table class="table-bordered salesTable">
			<tr>
				<th class="tableHeader" width="10%">TransactionID</th>
				<th class="tableHeader" width="15%">Date</th>
				<th class="tableHeader" width="25%">Total €</th>
				<th class="tableHeader" width="17%">Dine In Sales €</th>
				<th class="tableHeader" width="17%">Take Out Sales €</th>
				<th class="tableHeader" width="16%">Delivery Sales € </th>
			</tr>
	';
	// fetch the data and populate
	if( mysqli_num_rows($result) > 0 ) {
		// go through each column [Field] in associative array $row
		while( $row = mysqli_fetch_array($result) ){

			$outputTable .= ' 
				<tr id="salesRow_'.$row["TransactionID"].'">
					<td align="center" class="tableContent">'.$row["TransactionID"].'</td>
					<td align="center" class="tableContent">'.$row["SalesDate"].'</td>
					<td align="center" class="tableContent">'.$row["TotalSales"].'</td>
					<td align="center" class="tableContent">'.$row["DineInSales"].'</td>
					<td align="center" class="tableContent">'.$row["TakeAwaySales"].'</td>
					<td align="center" class="tableContent">'.$row["DeliverySales"].'</td>
					
					<form class="form-group"  action="controller_selectEditDeleteSales.php" method="post">
					<td><input class="editSales_button btn btn-warning" id="'.$row["TransactionID"].'" type="submit" name="editSales_button" value="EDIT"></td>
					<td><input class="delSales_button btn btn-danger" id="'.$row["TransactionID"].'" type="submit" name="delSales_button" value="DELETE"></td>
					<input type="hidden" value="'.$row['TransactionID'].'" name="TransactionID">
				</tr>
			';       
		}
	} else {
		$msg.=  "<h3>Data not Found</h3>";
		$outputTable .= '
			<tr>
				<td colspan = "4">Data not Found</td>
			</tr>
		';
	}
	$outputTable .= '</table>';
	
} // end VIEW query



// VIEWS

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
//------------------
// ADMIN or MANAGER
//------------------
if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='admin') || ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='manager') ) {
	//main section content - logged in user
    //$contentStringMAIN.='<p>Welcome '.$_SESSION['user_FirstName'].' to your Dashboard.</p>';

	// if not used, INCLUDE insertSalesFORM in view instead
    $contentStringMAIN.='
	<div class="jumbotron">
		<h1>Lucky Cat Business Dashboard</h1>
		<p class="lead">
			<img src="images/luckycatDash.png" alt="lucky cat logo"><br>
		</p>';

	// Sales CRUD Options INSERT or EDIT/DELETE
    $contentStringMAIN.='';


    //logout form
	$contentStringMAIN.='<form method="post" action="controller_login_manager.php">';
	$contentStringMAIN.='<input name="logout" type="submit" id="logout" value="Log Out">';
	$contentStringMAIN.='</form>';
}
//------------------
// ACCOUNTANT
//------------------
else if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='accountant') ) {
	//main section content - logged in user
    //$contentStringMAIN.='<p>Welcome '.$_SESSION['user_FirstName'].' to your Dashboard.</p>';

    $contentStringMAIN.='
	<div class="jumbotron">
		<h1>Lucky Cat Business Dashboard</h1>
		<p class="lead">
			<img src="images/luckycatDash.png" alt="lucky cat logo"><br>
		</p>';




    //logout form
	$contentStringMAIN.='
	<form method="post" action="controller_login_manager.php">
		<input name="logout" type="submit""  id="logout" value="Log Out">
	</form>';
}
else{
	// =====================
	// 		Log In Form
	// =====================
	//main section content - user not logged in
	// shouldn't be on this page if controller did its job

	$contentStringMAIN.='
		<form class="login" method="post" action="controller_login_manager.php">
			<div class ="container">
				<div class ="row">
					<h2>Please Login</h2>
					<table class="form">
						<tr><td>
						<label>
							<span>UserName</span><input name="username" type="text" placeholder="username" autofocus required>
							<span>Password</span><input name="password" type="password" placeholder="password" required>
						</label>
						</td></tr>
					<tr><td>
					</td></tr>
					<tr><td>
					<label>
						<input name="login" type="submit" id="login" class="btn btn-info" value="Login">
					</label>
					</td></tr>
					</table>
				</div>
			</div>
		</form>';

	// $dateTest = "<script>
    // moment( ($('#saleDate').val())), 'YYYY-MM-DD' );
    //  </script>";
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