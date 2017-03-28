<!doctype html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9 lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->

<head>
<meta charset="utf-8">
<title><?php echo $tab; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo __CSS;?>">

 <meta name="description" content="">
<meta name="viewport" content="width=device-width">

<!--============= STYLES section=============-->
<!--========================================-->
<?php include("inc/head.php"); ?>

</head>
<body>
<!--[if lte IE 8]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!--============= HEADER section=============-->
<!--========================================-->
<header>
<h2><?php echo $pageHeading; ?></h2>
</header>

<!--============= NAVIGATION section=============-->
<!--========================================-->

<nav>
   <?php include("inc/header.php"); ?>
</nav>


<!--============= MAIN section=============-->
<!--========================================-->
<section>
    <?php include("modules/main/view_main.php"); ?>
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
<?php include('inc/tail.php'); ?>
</body>
</html>
















 



