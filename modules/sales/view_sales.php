<!-- <h2> Sales CRUD Page </h2>
<p>This is the SALES view.</p> -->
<!doctype html>

<head>
<meta charset="utf-8">
<title><?php echo $tab; ?></title>

<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<!--============= STYLES=============-->
<!--========================================-->
<?php require("inc/head.php"); ?>

</head>
<body>
<!--============= HEADER section=============-->
<!--========================================-->
<header>
	<h2><?php echo $pageHeading; ?></h2>
</header>

<!--============= NAVIGATION section=============-->
<!--========================================-->
<nav>
<?php echo $contentStringNAV; ?>
</nav>

<!--============= MAIN section=============-->
<!--========================================-->
<section>
    <?php echo $contentStringMAIN; ?>
</section>

    <!--[if lt IE 9]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. 
        Please <a href="http://browsehappy.com/">upgrade your browser</a> 
        or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

<!--============= FOOTER section=============-->
<!--========================================-->
<?php echo $contentStringFOOTER; ?>
<!-- JAVASCRIPT -->
<?php require('inc/tail.php'); ?>
</body>
</html>
















 























 



