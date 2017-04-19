<!doctype html>

<head>
<meta charset="utf-8">
<title><?php echo $tab; ?></title>

<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<!--============= STYLES=============-->
<!--========================================-->
<?php require("inc/head.php"); ?> 
<!--<?php echo "<p>Register User view loaded</p>"; ?>-->
</head>
<body>
<!--============= HEADER section=============-->
<!--========================================-->
<header>
<h2>Registration</h2>
</header>

<!--============= NAVIGATION section=============-->
<!--========================================-->
<nav>
<?php echo $contentStringNAV;?>
</nav>


<!--============= MAIN section=============-->
<!--========================================-->
<section>
	<div id ="countdown"></div>
<?php 
	echo $msg;
	echo "<br/>";
	echo $contentStringMAIN;
	//generateTable($table, $arrayTitles, $arrayData);
?>
</section>

<!--============= FOOTER section=============-->
<!--========================================-->
<?php echo $contentStringFOOTER; ?> 
<!-- JAVASCRIPT -->
<?php include('inc/tail.php'); ?>

<script>
// countdown for redirect
$(document).ready(function() {
	var delay = 10 ;
	var url = "controller_main.php";
	function countdown() {
		setTimeout(countdown, 1000) ;
		$('#countdown').html("Redirecting in "  + delay  + " seconds.");
		delay --;
		if (delay < 0 ) {
		window.location = url ;
		delay = 0 ;
		}
	}
	countdown() ;
});

</script>

</body>
</html>















 



