<META HTTP-EQUIV="Content-Type" CONTENT="text/html;" charset="UTF-8">
<html>
<head>
<title><?php echo $tab; ?></title>

<!--============= STYLES=============-->
<!--========================================-->
<?php require("inc/head.php"); ?>

</head>
<body>
<!--==============HEADER SECTION====================-->
<!--====================================================-->
<header>
<h2><?php echo $pageHeading; ?></h2>
</header>

<!--==============NAVIGATION SECTION====================-->
<!--====================================================-->

<nav>
<?php echo $contentStringNAV;?>
</nav>


<!--==============MAIN SECTION====================-->
<!--====================================================-->
<section>
<?php 
	echo $contentStringMAIN;
	//if a valid ID has been entered - generate the edit record form. pass in four things, including the controller
	if($_SESSION['validID']){ generateSalesEditForm( $_SESSION['transactionID'], $_SESSION['date'],$_SESSION['dineSales'],$_SESSION['takeSales'],$_SESSION['delSales'],'controller_editSales.php' ); } 
 ?>

</section>

<!--==============FOOTER SECTION====================-->
<!--====================================================-->
<?php echo $contentStringFOOTER; ?>
<!-- JAVASCRIPT -->
<?php require('inc/tail.php'); ?>
</body>
</html>
















 



