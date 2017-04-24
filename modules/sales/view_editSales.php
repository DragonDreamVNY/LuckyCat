<!doctype html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9 lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo $tab; ?></title>

<meta name="description" content="">
<meta name="viewport" content="width=device-width">

<!--============= STYLES & JQuery section=============-->
<?php
//echo "<h2>Crud View loaded</h2>";
include("inc/head.php"); ?>
</head>
<body>
<!--[if lte IE 8]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!--============= HEADER section=============-->
<!--========================================-->
<header>
<h2>Sales Page</h2>
</header>

<!--============= NAVIGATION section=============-->
<!--========================================-->
<nav>
<!--<?php include("inc/nav.php"); ?>-->
<?php echo $contentStringNAV; ?> 

</nav>


<!--============= MAIN section=============-->
<!--========================================-->
<section>

<?php echo $contentStringMAIN; 

	$selectedTransactionID = $_SESSION['TransactionID'];
	$selectedSalesDate = $_SESSION['salesDate'];
	$selectedDineInSales =  $_SESSION['dineInSales'];
	$selectedTakeAwaySales = $_SESSION['takeAwaySales'];
	$selectedDeliverySales =  $_SESSION['deliverySales'];

if( $_SESSION['validTransactionID'] ){ 
    // generateSalesEditForm($_SESSION['TransactionID'], $_SESSION['salesDate'],$_SESSION['dineInSales'],'controller_Ex01_edit_simple.php'); 
    generateSalesEditForm( $selectedTransactionID, $selectedSalesDate,$_SESSION['lastName'],'controller_Ex01_edit_simple.php'); 

} 
?>

<div id="resultTable" class="table-responsive">
<!--display sales table here with update and delete records option-->
</div>

<div class ="container">
    <form id="formControlSalesInsert" class="form-inline" method="post" autocomplete="on" action="controller_insertSales.php">
        <h2>Insert Sales Form</h2>

        <!--date picker-->


                <div class="col-md-12">
                    
                    <div class="form-group">
                        
                        <div class="date" id="datetimepicker1">
                            <label for "saleDate">Pick Date</label>
                            <input name="sale_DatePicked" id="saleDate" type="text" class="form-control">
                        </div>
                    </div>

                    <!--<div id="output"></div>
                    <div id="output2"></div>
                    <div id="output3"></div>
                    <div id="output4"></div>
                    <div id="output5"></div>-->
                </div>


        <!--end date picker: see JavaScript for settings-->

        <div id = "saleValues" class="form-inline"> 
            <div class="form-group">
                <label for "dineSales_Input"> DineIn: €</label>
                <input name="dine_Sales" id="dineSales_Input"  class="form-control salesInputs" type="number" step="0.10" value="" required>
                <br>
                <label for "takeSales_Input">TakeOut: €</label>
                <input name="take_Sales" id="take_Sales" class="form-control salesInputs" type="number" step="0.10" value="" required>     
                <br>
                <label for "delSales_Input">Deliveries: €</label>
                <input name="deliver_Sales" id="delSales_Input" class="form-control salesInputs" type="number" step="0.01" value="" required> 
                <div id="saleSumTotal"></div>    
            </div>
        </div>

        <div>
            <!--<label>
                <input name="btn_insertSales" class="btn btn-primary" type="submit" id="insertSales_Button" value="Insert" value="" readonly>
            </label>-->

            <!--for update queries on current record selected-->
            <input type = "hidden" name="id" id="TransactionID" /> 
            
            <!--Button text updated by AJAX and calls different queries-->
            <button type="button" name="action" id="action" class="btn btn-warning">Insert</button>
        </div>
        
    </form>
</div>




</section>


<!--============= FOOTER section=============-->
<!--========================================-->
<?php echo $contentStringFOOTER; ?> 
<!-- JAVASCRIPT -->
<?php include('inc/tail.php'); ?>

<script> 
$(document).ready(function(){
    //fetch Sales from Database and display in Table
    fetchSales(); // called on webpage load
    function fetchSales(){ 
        var action = "select"; //use this in PHP
        $.ajax({
            url:"library/actionforSales.php", // call the variables from the model for AJAX rewrite
            method:"POST", //sends data to server
            data:{action:action}, // when 'action' button is pressed
            success:function(data){ // success callback function if successful, 
                //clear input fields
                $('#sale_DatePicked').val('');
                $('#dine_Sales').val('');
                $('#take_Sales').val('');
                $('#deliver_Sales').val('');
                $('#action').text('Insert');
                $('#resultTable').html(data); //generate the Table
            }
        })
    }
    totalSales();
    function totalSales(){
		//console.log('starting sales inputs : ');
		$('.salesInputs').on('change paste keyup', function() {
			var sum = 0;
			$('.salesInputs').each(function(){
				sum += +$(this).val();
			});
			$('#saleSumTotal').html('<label>Sale Total : € </label> ' + sum);
			//console.log('Sale Total is : € ' + sum);
		});
	}
});
</script>

</body>
</html>
















 



