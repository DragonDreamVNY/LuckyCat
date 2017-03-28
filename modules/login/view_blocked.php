<!DOCTYPE html>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html;" charset="UTF-8">
<html>
<head>
<title><?php echo $title; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo __CSS;?>">
</head>
<body>
<!----------------- HEADER SECTION ----------------------->
<!--====================================================-->
<header>
<h2><?php echo $pageHeading; ?></h2>
</header>
<?php

//----------------NAVIGATION SECTION----------------------//
//========================================================//
echo '<nav>';
echo "<h3>NAV SECTION</h3>";
echo '<a href="http://php.net/manual/en/book.mysqli.php">MySQLi Manual</a><br>';
echo '<h4>Examples</h4>';
echo '<a href="controller_main.php">HOME</a><br>';
echo "</nav>";
?>

<!------------------MAIN SECTION----------------------------->
<!--=======================================================-->
<section>
<h2>Login - Access is Denied</h2>
<p>There appears to be some problem with your username/password.</p>
<p>You have exceeded the number of permitted attempts to login. </p>
<p>Please contact your system administrator to gain access to your account. </p>
</section>





<?php
//----------------RHS SECTION-----------------------------//
//========================================================//
echo '<section class="right">';
echo "<h3>LOGIN STATUS</h3>";
echo "Login is blocked.";
echo '</section>';
?>





<?php
//----------------FOOTER section--------------------------//
//========================================================//

//warn DEBUG  mode is on
if (__DEBUG==1) 
	{	
	
	echo '<footer class="debug">';
	echo '<h3>DEBUG</h3>';
	
	echo '<h4>$_COOKIE Array</h4>';
	foreach($_COOKIE as $key=>$value){
		echo '$_COOKIE[\''.$key."'] = ".$value.'</br>';
	}
	
	echo '<h4>$_SESSION Array</h4>';
	foreach($_SESSION as $key=>$value){
		echo '$_SESSION[\''.$key."'] = ".$value.'</br>';
	}
	
	echo '<h4>$_POST Array</h4>';
	foreach($_POST as $key=>$value){
		echo '$_POST[\''.$key."'] = ".$value.'</br>';
	}
	
	echo "</footer>";


	}
	else
	{
	echo '<footer class="copyright">';
	echo 'Copyright 2017 Gerry Guinane';
	echo "</footer>";
	}


?>

</body>
<head>
<!--Cache Control-->
	<meta http-equiv="cache-control" content="no-cache,no-store,must-revalidate">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="expires" content=“-1">
</head>
</html>



















 



