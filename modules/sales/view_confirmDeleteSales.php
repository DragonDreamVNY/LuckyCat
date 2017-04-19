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
<!----------------- HEADER SECTION ----------------------->
<!-------------------------------------------------------->
<header>
<h2><?php echo $pageHeading; ?></h2>
</header>

<!----------------NAVIGATION SECTION---------------------->
<!-------------------------------------------------------->

<nav>
<?php echo $contentStringNAV;?>
</nav>


<!----------------MAIN SECTION---------------------------->
<!-------------------------------------------------------->
<section>
<?php 
	echo $contentStringMAIN;


 ?>


</section>


<!----------------RHS SECTION----------------------------->
<!-------------------------------------------------------->
<section class="right">
<?php echo $contentStringRHS; ?>
</section>



<!----------------FOOTER section-------------------------->
<!-------------------------------------------------------->
<?php echo $contentStringFOOTER; ?>
</body>
</html>
















 



