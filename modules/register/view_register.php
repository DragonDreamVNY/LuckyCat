<!doctype html>

<head>
<meta charset="utf-8">
<title><?php echo $tab; ?></title>

<!--STYLES & jQuery Library-->
<?php require("inc/head.php"); ?>		
</head>
<body>

<!--============= HEADER section=============-->
<!--========================================-->
<header>

    
</header>

<!--============= NAVIGATION section=============-->
<!--========================================-->

<nav>
   <?php echo $contentStringNAV; ?>
</nav>


<!--============= MAIN section=============-->
<!--========================================-->
<section class = "container">
	<div>
<?php 
//echo $contentStringMAIN;
include 'forms/registerForm.html'; 
 ?>
 <div>
</section>

<!--============= FOOTER section=============-->
<!--========================================-->
<?php echo $contentStringFOOTER; ?>
<!-- JAVASCRIPT -->
<?php require('inc/tail.php'); ?>
<script src="library/scripts/pwStrengthScript.js"></script>	
</body>
</html>
















 



