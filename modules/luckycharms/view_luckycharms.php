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
<h2>
    <?php echo $pageHeading ?>
</h2>
</header>

<!--============= NAVIGATION section=============-->
<!--========================================-->
<nav>
<?php echo $contentStringNAV; ?> 
</nav>

<!--============= MAIN section=============-->
<!--========================================-->
<section>

<div id="currentCharms"></div>

<!--Table-->
<?php echo $outputTable; ?>
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

 <script>
    $(document).ready(function(){
	// var charmIDSplitArray = "#charmStatusCell".id.split('-');
	// var charmID = charmIDSplitArray[1]; 
	// // var charmID = $('#charmStatusCell'+charm_ID);
	// var charmTable = $("#luckyCharmsTable");
	// // var charmRow = table.rows[index];
	// var charmStatus = $(".charmStatusCell").value;
	// console.log(charmStatus);
	// if (charmStatus == "ON"){ 
	// 	$('#charmStatusCell-'+charm_ID).addClass( "charmStatusON" );
	// }
	// else{ 
	// 	$('#charmStatusCell-'+charm_ID).addClass( "charmStatusOFF" );
	// }

 	$('#luckyCharmsTable td.charmStatusCell').each( function(){
        if ($(this).text() == 'ON') {
            $(this).css('background-color','#B3DEC1');
        }
        else{ $(this).css('background-color','#E9AFA3'); }
    });
}); //end document read

function fetchCharms(){ 
	var action = "Load"; //use this in PHP
	$.ajax({
		url:"modules/luckycharms/view_luckyCharms.php", // call the variables from the model for AJAX rewrite
		method:"POST", // sends data to server
		data:{action:action}, // when 'action' button is pressed
		success:function(data){ // success callback function, receives data from server stored
			console.log("========================");
			console.log("fetching charms");
			// console.log("data");
			// console.log(data);
			console.log("========================");

			$('#currentCharms').html(data); // generate the Table for div with id 'currentCharms'	
			
		}
	})
} // end loadSales


</script>
</body>
</html>