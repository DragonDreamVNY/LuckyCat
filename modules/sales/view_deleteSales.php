<?php
//============================
//Start/join a session
//this must come BEFORE the <HTML> tag
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html;" charset="UTF-8">
<html>
<head>
<title><?php echo $tab; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo __CSS;?>">
</head>
<body>
<!--==============HEADER SECTION====================-->
<!--====================================================-->
<header>
<h2><?php echo $pageHeading; ?></h2>
</header>

<!--============= NAVIGATION section=============-->
<!--========================================-->

<nav>
<?php echo $contentStringNAV; ?>
</nav>


<!--==============MAIN SECTION====================-->
<!--====================================================-->
<section>
<?php 
	echo $contentStringMAIN;
	
	if ($_SESSION['validID']){ //if a valid ID has been selected - confirm deletion
		generateTable($table, $arrayTitles, $arrayData);	
		include ('forms/confirmSalesDeleteForm.html');
	}

 ?>
</section>

<!--============= FOOTER section=============-->
<!--========================================-->
<?php echo $contentStringFOOTER; ?>
<!-- JAVASCRIPT -->
<?php require('inc/tail.php'); ?>
</body>
</html>
















 



