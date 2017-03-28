<?php
//initialise session variables
if(!isset($_SESSION['loggedin'])){$_SESSION['loggedin']=0;}
if(!isset($_SESSION['loginAttempts'])){$_SESSION['loginAttempts']=0;}
if(!isset($_SESSION['views'])){$_SESSION['views']=0;}

//template values
$title='Lucky Cat Dashboard';
$pageHeading='Log In';

if ($_SESSION['loggedin']==1){
	//nav section content - logged in user
	$contentStringNAV='<header id="SiteHeader" class = "header">';
	$contentStringNAV.= '<h2>Welcome</h2>';
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
	$contentStringNAV.= 	'<div class="container">';
	$contentStringNAV.= 		'<div class="navbar-header">';
	$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
	$contentStringNAV.= 	'</div>';

	$contentStringNAV.= 	'<ul class="nav navbar-nav">';
	$contentStringNAV.= 		'<li class="active"><a href="index.php">Home</a></li>';
	$contentStringNAV.= 		'<li><a href="modules/sales/view_sales.php">Sales</a></li>';
	$contentStringNAV.= 		'<li><a href="modules/performance//view_kpi.php">Performance View</a></li>';
	$contentStringNAV.= 		'<li><a href="modules/luckycharms/luckycharms.php">Lucky Charms</a></li>';
	$contentStringNAV.= 		'<li><a href="controller_login_manager.php">RELOAD</a></li>';
	$contentStringNAV.= 	'</ul>';	
	$contentStringNAV.= 	'</div>';
	$contentStringNAV.= '</div>';
	$contentStringNAV.= '</header>';

}
else{
	//nav section content - not logged in
	$contentStringNAV='';
	$contentStringNAV.='<a href="controller_main.php">HOME</a></br>';
}
$pageHeading = "";
//main section content:
$contentStringMAIN=''; 
if ($_SESSION['loggedin']==1){
	//main section content - logged in user
    $contentStringMAIN.='<p>Welcome '.$_SESSION['firstName'].' to your Dashboard.</p>';

    $contentStringMAIN.='<div class="jumbotron">';
	$contentStringMAIN.=	'<h1>Lucky Cat Business Dashboard</h1>';
	$contentStringMAIN.=	'<p class="lead">';
	$contentStringMAIN.=	'<img src="images/luckycatDash.png" alt="lucky cat logo"><br>';
	$contentStringMAIN.=	'</p>';
    $contentStringMAIN.=	'<div class="btn-group">';

    $contentStringMAIN.=		'<a href="modules/sales/view_sales.php"><button class="btn btn-success" role="button">';
    $contentStringMAIN.=		'Sales Data';
    $contentStringMAIN.=		'</button></a>';

	$contentStringMAIN.=		'<a href="modules/performance/kpi.php"><button class="btn btn-primary" role="button">';
    $contentStringMAIN.=		'Performance View';
    $contentStringMAIN.=		'</button></a>';

    $contentStringMAIN.=		'<a href="modules/luckycharms/luckycharms.php"><button class="btn btn-danger" role="button">';
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
	$contentStringFOOTER.='<footer class="copyright">';
	$contentStringFOOTER.= 'Copyright 2017 Vincent Lee';
	$contentStringFOOTER.= "</footer>";
}

?>

















 



