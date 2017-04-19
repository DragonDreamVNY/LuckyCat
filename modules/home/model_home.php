<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//initialise session variables
if(!isset($_SESSION['loggedin'])){ $_SESSION['loggedin']=FALSE; }
if(!isset($_SESSION['loginAttempts'])){$_SESSION['loginAttempts'] = 0;}
if(!isset($_SESSION['views'])){$_SESSION['views'] = 0;}

//template values
$title='Lucky Cat Dashboard';
$pageHeading='Log In';

if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='admin') || ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='owner') ) {
	//nav section content - logged in user
	// $contentStringNAV='<header id="SiteHeader" class = "header">';
	$contentStringNAV.= '<h2>Welcome</h2>';
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
	$contentStringNAV.= 	'<div class="container">';
	$contentStringNAV.= 		'<div class="navbar-header">';
	$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
	$contentStringNAV.= 	'</div>';

	$contentStringNAV.= 	'<ul class="nav navbar-nav">';
	$contentStringNAV.= 		'<li class="active"><a href="index.php">Home</a></li>';
	$contentStringNAV.= 		'<li><a href="controller_sales.php">Sales</a></li>'; //sales main page
	$contentStringNAV.= 		'<li><a href="controller_performance.php">Performance View</a></li>';
	$contentStringNAV.= 		'<li><a href="controller_charms.php">Lucky Charms</a></li>';
	$contentStringNAV.= 		'<li><a href="controller_login_manager.php">RELOAD</a></li>';
	$contentStringNAV.= 	'</ul>';	
	$contentStringNAV.= 	'</div>';
	$contentStringNAV.= '</div>';
	// $contentStringNAV.= '</header>';

}
else{
	//nav section content - not logged in
	$contentStringNAV='';
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
	$contentStringNAV.= 	'<div class="container">';
	$contentStringNAV.= 		'<div class="navbar-header">';
	$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
	$contentStringNAV.= 	'</div>';
	$contentStringNAV.= 	'<ul class="nav navbar-nav">';
	$contentStringNAV.= 		'<li class="active"><a href="index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp;Home</a></li>';
	$contentStringNAV.= 	'</ul>';	
	$contentStringNAV.= 	'</div>';
	$contentStringNAV.= '</div>';
}
$pageHeading = "";
//main section content:
$contentStringMAIN=''; 
if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='admin') || ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='owner') ) {
	//main section content - logged in user
    $contentStringMAIN.='<p>Welcome '.$_SESSION['user_FirstName'].' to your Dashboard.</p>';

    $contentStringMAIN.='<div class="jumbotron">';
	$contentStringMAIN.=	'<h1>Lucky Cat Business Dashboard</h1>';
	$contentStringMAIN.=	'<p class="lead">';
	$contentStringMAIN.=	'<img src="images/luckycatDash.png" alt="lucky cat logo"><br>';
	$contentStringMAIN.=	'</p>';
    $contentStringMAIN.=	'<div class="btn-group">';

    $contentStringMAIN.=		'<a href="controller_crudSales.php"><button class="btn btn-success" role="button">';
    $contentStringMAIN.=		'Sales Data';
    $contentStringMAIN.=		'</button></a>';

	$contentStringMAIN.=		'<a href="controller_performance.php"><button class="btn btn-primary" role="button">';
    $contentStringMAIN.=		'Performance View';
    $contentStringMAIN.=		'</button></a>';

    $contentStringMAIN.=		'<a href="modules/luckycharms/view_luckycharms.php"><button class="btn btn-danger" role="button">';
    $contentStringMAIN.=		'Lucky Charms';
    $contentStringMAIN.=		'</button></a>';
    $contentStringMAIN.=	'</div>';
    $contentStringMAIN.='</div>';


    //logout form
	$contentStringMAIN.='<form method="post" action="controller_login_manager.php">';
	$contentStringMAIN.='<input name="logout3" type="submit" id="logout3" value="Log Out">';
	$contentStringMAIN.='</form>';

}
else{
	// Log In Form
	//main section content - user not logged in
	
	$contentStringMAIN.='<form class="login" method="post" action="controller_login_manager.php">';
	$contentStringMAIN.='	<div class ="container">';
	$contentStringMAIN.='		<div class ="row">';
	$contentStringMAIN.='			<h2>Please Login to Lucky Cat Dashboard</h2>';
	$contentStringMAIN.='			<div class="form-group">';
	$contentStringMAIN.='		    	<label for "username">UserName</label>';
	$contentStringMAIN.='		        <input name="username" class="form-control" type="text" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$"  placeholder="enter username" autofocus required>';
	$contentStringMAIN.='		    </div>';
	$contentStringMAIN.='			<div class="form-group">';
	$contentStringMAIN.='		    	<label>Password</label>';
	// $contentStringMAIN.='		        <input name="password" class="form-control" type="password" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder="enter password (uppercase,lower,number and minimum 6 characters)" required>';
	$contentStringMAIN.='		        <input name="password" class="form-control" type="password" placeholder="enter password" required>';
	$contentStringMAIN.='		    </div>';
	$contentStringMAIN.='		    <button name="login" id="login" type="submit" class="btn btn-info" value="Login">Submit</button>';
	$contentStringMAIN.='		</div>';
	$contentStringMAIN.='	</div>';
	$contentStringMAIN.='</form>';

	$contentStringMAIN.='<div class ="container">';
	$contentStringMAIN.=	'<h3>New User Register here</h3>';
	$contentStringMAIN.=	'<a href="controller_register.php"><button class="btn btn-default" role="button">';
    $contentStringMAIN.=	'REGISTER';
    $contentStringMAIN.=	'</button></a>';
	$contentStringMAIN.='</div>';
}

//footer section content
$contentStringFOOTER='';
if (__DEBUG==TRUE) //construct the footer with debug information 
{	
        $contentStringFOOTER.= '<footer class="debug copyright">';
        $contentStringFOOTER.= '<div class ="container">';
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
        $contentStringFOOTER.= '</div>';
		$contentStringFOOTER.= '<div class ="cold-md-12">';
		$contentStringFOOTER.= '<div class = "col-md-offset-1">';
        $contentStringFOOTER.= 		'Copyright 2017 Vincent Lee';
		$contentStringFOOTER.= '</div>';
		$contentStringFOOTER.= '</div>';
        $contentStringFOOTER.=  "</footer>";
}
else{ //construct the standard footer
	$contentStringFOOTER.='<footer class="copyright">';
	
	$contentStringFOOTER.= "</footer>";
}

?>

















 



