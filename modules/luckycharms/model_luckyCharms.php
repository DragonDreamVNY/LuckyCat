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
// echo $CTRLmsg;
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
$pageHeading='Lucky Charms';

//initialise variables
$table='luckCharms';  //table to insert values into
$msg='';  //this is an empty message initially , it will contain the result of the insertion

// =====================
// DATABASE QUERIES
// =====================
$outputTable = '';
 
$sqlViewQuery = "SELECT * FROM luckycat.view_lucky_charms_withUser;";

// =====================
// LUCKY CHARMS TABLE
// execute the CHARMS joined VIEW and populate Table
// =====================
if( mysqli_query($conn,$sqlViewQuery)==TRUE ) { // table query success
	$msg .= "<h2>Lucky Charms Promos</h2>";
	$result = mysqli_query($conn,$sqlViewQuery); // store View in result variable
	// construct the table headers
	if(__DEBUG == TRUE){
		echo "<br/>";
		echo "<h4>MySQLi result Array:</h4>";
		print_r($result);
	}

	//(3) HTML Table is created filled with data sent to "resultsTable" placeholder
	$outputTable .= '
		<table id="luckyCharmsTable"  class="table-bordered charmsTable">
			<tr>
				<th class="tableHeader" width="10%">CharmID</th>
				<th class="tableHeader" width="15%">Lucky Charm Name</th>
				<th class="tableHeader" width="30%">Description</th>
				<th class="tableHeader" width="14%">STATUS</th>
				<th class="tableHeader" width="15%">Last Updated by</th>
			</tr>
	';
	// fetch the data and populate
	if( mysqli_num_rows($result) > 0 ) {
		$charmStatus = '';
		// go through each column [Field] in associative array $row
		while( $row = mysqli_fetch_array($result) ){
			
			if($row["charm_Status"] == 1 ){ $charmStatus = 'ON'; }
			elseif($row["charm_Status"] == 0 ){ $charmStatus = 'OFF'; }

			$outputTable .= ' 
				<tr id="charmsRow_'.$row["charm_ID"].'">
					<td align="center" class="tableContent">'.$row["charm_ID"].'</td>
					<td align="center" class="tableContent">'.$row["charm_Name"].'</td>
					<td align="center" class="tableContent">'.$row["charm_Description"].'</td>
					<td align="center" class="tableContent charmStatusCell" id="charmStatusCell-'.$row["charm_ID"].'">'.$charmStatus.'</td>
					<td align="center" class="tableContent">'.$row["user_LogInName"].'</td>
					
					<form class="form-group"  action="controller_editCharms.php" method="post">
					<td><input class="editCharm_button btn btn-warning" id="edit-'.$row["charm_ID"].'" type="submit" name="editCharm_button" value="EDIT"></td>
					<td><input class="delCharm_button btn btn-danger" id="delete-'.$row["charm_ID"].'" type="submit" name="delCharm_button" value="DELETE"></td>
					<input type="hidden" value="'.$row['charm_ID'].'" name="charm_ID">
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
	
} // end CHARMS VIEW query
//----------------------------


// VIEWS variables
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
					<li><a href="controller_sales.php">Sales</a></li>
					<li><a href="controller_performance.php">Performance View</a></li>
					<li class="active"><a href="controller_charms.php">Lucky Charms</a></li>
				</ul>	
			</div>
		</div>';
}

// MARKETER
else if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='marketer') ) {
	//nav section content - logged in user
	// $contentStringNAV='<header id="SiteHeader" class = "header">';
	$contentStringNAV.= '
		<div class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
				<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>
				</div>

				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="controller_performance.php">Performance View</a></li>
					<li class="active"><a href="controller_charms.php">Lucky Charms</a></li>
				</ul>	
			</div>
		</div>';
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

	// ToDo: CRUD Options INSERT or EDIT/DELETE here for Lucky Charms
	// options:
	// a. pop up modal with form (works better with AJAX to prevent page refresh after Form POST)
	// b. standard input form with hidden fields.
	// To Do: carry SESSION for "ON" or active Lucky Charms to Front page to append to div? 
	// ?? how to carry more than one item from each "ON" row?
	// ?? AJAX to call fetchLuckyCharms() and return only rows with luckycharm_status== 1 ???


    //logout form
	$contentStringMAIN.='<form method="post" action="controller_login_manager.php">';
	$contentStringMAIN.='<input name="logout" type="submit" id="logout" value="Log Out">';
	$contentStringMAIN.='</form>';
}
//------------------
// MARKETER
//------------------
else if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='marketer') ) {
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
	// shouldn't be on this page if controller did its job, NOT LOGGED IN user would be redirected to HOME with Log In Form

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
}

//footer section content
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
<script>

</script>