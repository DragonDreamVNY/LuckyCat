<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//initialise session variables
if(!isset($_SESSION['loggedin'])){$_SESSION['loggedin']=false;}
if(!isset($_SESSION['loginAttempts'])){$_SESSION['loginAttempts']=0;}
if(!isset($_SESSION['views'])){$_SESSION['views']=0;}

// $_SESSION['loggedin']=true; //logged In

//prepare view template values
//$tab='Lucky Cat';
$pageHeading='Sales Page';

//initialise variables
$table='sales';  //table to insert values into
$msg='';  //this is an empty message initially , it will contain the result of the insertion

// =====================
// 		NAVIGATION
// =====================
//nav section content - logged in user
//------------------
// ADMIN or MANAGER
//------------------
if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='admin') || ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='manager') ) {
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
				<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>
				</div>

				<ul class="nav navbar-nav">
					<li><a href="index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp;Home</a></li>
					<li class="active"><a href="controller_sales.php">Sales</a></li>
					<li><a href="controller_performance.php">Performance View</a></li>
					<li><a href="controller_charms.php">Lucky Charms</a></li>
				</ul>	
			</div>
		</div>';
}
//------------------
// MARKETING
//------------------
else if( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='marketer') ) {
	//nav section content - logged in user
	// $contentStringNAV='<header id="SiteHeader" class = "header">';
	$contentStringNAV.= "<h2>Welcome $userFirstName</h2>";
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
	$contentStringNAV.= 	'<div class="container">';
	$contentStringNAV.= 		'<div class="navbar-header">';
	$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
	$contentStringNAV.= 	'</div>';

	$contentStringNAV.= 	'<ul class="nav navbar-nav">';
	$contentStringNAV.= 		'<li"><a href="index.php">Home</a></li>';
	$contentStringNAV.= 		'<li class="active"><a href="controller_performance.php">Performance View</a></li>';
	$contentStringNAV.= 		'<li><a href="controller_charms.php">Lucky Charms</a></li>';
	$contentStringNAV.= 	'</ul>';	
	$contentStringNAV.= 	'</div>';
	$contentStringNAV.= '</div>';
	// $contentStringNAV.= '</header>';
}
//------------------
// ACCOUNTANT
//------------------
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

if ($_SESSION['loggedin']==true){
	//main section content - logged in user
    //$contentStringMAIN.='<p>Hello '.$_SESSION['user_FirstName'].' : Please select from below.</p>';

    $contentStringMAIN.='<div class="jumbotron">';
	$contentStringMAIN.=	'<h1>Lucky Cat Business Dashboard</h1>';
	$contentStringMAIN.=	'<p class="lead">';
	$contentStringMAIN.=	'<img src="images/luckycatDash.png" alt="lucky cat logo"><br>';
	$contentStringMAIN.=	'</p>';

	// Sales CRUD selections
    $contentStringMAIN.=	'<div class="btn-group">';
    $contentStringMAIN.=		'<a href="controller_insertSales.php"><button class="btn btn-info" role="button">';
    $contentStringMAIN.=		'Insert/Edit Sales Data';
    $contentStringMAIN.=		'</button></a>';

	$contentStringMAIN.=		'<a href="controller_crudSales.php"><button class="btn btn-warning" role="button">';
    $contentStringMAIN.=		'Update Sales Data V2';
    $contentStringMAIN.=		'</button></a>';
    $contentStringMAIN.=	'</div>';
    $contentStringMAIN.='</div>'; //end jumbo

    //logout form
	$contentStringMAIN.='<form method="post" action="controller_login_manager.php">';
	$contentStringMAIN.='<input name="logout" type="submit" id="logout" value="Log Out">';
	$contentStringMAIN.='</form>';

}
else{
	// =====================
	// 		Log In Form
	// =====================
	//main section content - user not logged in
	
	$contentStringMAIN.='<form class="login" method="post" action="controller_login_manager.php">';
	$contentStringMAIN.='	<div class ="container">';
	$contentStringMAIN.='		<div class ="row">';
	$contentStringMAIN.='			<h2>Please Login</h2>';
	$contentStringMAIN.='			<table class="form">';
	$contentStringMAIN.='		    	<tr><td>';
	$contentStringMAIN.='		    	<label>';
	$contentStringMAIN.='		        	<span>UserName</span><input name="username" type="text" placeholder="username" autofocus>';
	$contentStringMAIN.='		        	<span>Password</span><input name="password" type="password" placeholder="password">';
	$contentStringMAIN.='		   	 	</label>';
	$contentStringMAIN.='		    	</td></tr>';
	$contentStringMAIN.='			<tr><td>';
	$contentStringMAIN.='			</td></tr>';
	$contentStringMAIN.='			<tr><td>';
	$contentStringMAIN.='		    <label>';
	$contentStringMAIN.='		        <input name="login" type="submit" id="login" class="btn btn-info" value="Login">';
	$contentStringMAIN.='		    </label>';
	$contentStringMAIN.='		    </td></tr>';
	$contentStringMAIN.='			</table>';
	$contentStringMAIN.='		</div>';
	$contentStringMAIN.='	</div>';
	$contentStringMAIN.='</form>';
}

//footer section content
$contentStringFOOTER='';
if (__DEBUG==1) //construct the footer with debug information 
	{	
		$contentStringFOOTER.= '<footer class="debug">';

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