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

<!--============= STYLES section=============-->
<?php
//echo "<h2>Crud Page loaded</h2>";
include("inc/head.php"); 
?>
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

<?php
if ($_SESSION['loggedin']==TRUE){
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
				<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>
				</div>

				<ul class="nav navbar-nav">
					<li><a href="index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp;Home</a></li>
					<li class="active"><a href="controller_sales.php">Sales</a></li>
					<li><a href="controller_performance.php">Performance View</a></li>
					<li><a href="controller_charms.php">Lucky Charms</a></li>
					<li><a href="controller_login_manager.php">RELOAD</a></li>
				</ul>	
			</div>
		</div>';
}
else{
	//nav section content - not logged in
	$contentStringNAV='';
	$contentStringNAV.='You Are NOT LOGGED IN boo';
	$contentStringNAV.='<a href="controller_main.php">HOME</a></br>';
}
echo $contentStringNAV;
?>


</nav>


<!--============= MAIN section=============-->
<!--========================================-->
<section>
    <div class ="container box">
        <!--<form id="formSales" class="form-inline" autocomplete="on">-->
            <h2>Sales Insert/Update</h2>
            <!--date picker-->
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="date" id="datetimepicker1">
                                    <label for "sale_date">Pick Date</label>
                                    <input name="sale_date" id="sale_date" type="text" class="form-control">
                                </div>
                            </div>
                        
                            <!--<div id="output"></div>
                            <div id="outputTest"></div>
                            <div id="output2"></div>
                            <div id="output3"></div>
                            <div id="output4"></div>
                            <div id="output5"></div>-->
                        </div>
                    </div>
            <!--end date picker: see JavaScript for settings-->

            <div id = "saleValues" class="form-inline"> 
                <div class="form-group">
                    <label for "dineIn_sales"> DineIn: €</label>
                    <input name="dineIn_sales" id="dineIn_sales"  class="form-control salesInputs" type="number" step="0.10" value="" required>
                    <br>
                    <label for "takeOut_sales">TakeOut: €</label>
                    <input name="takeOut_sales" id="takeOut_sales" class="form-control salesInputs" type="number" step="0.10" value="" required>     
                    <br>
                    <label for "delivery_sales">Deliveries: €</label>
                    <input name="delivery_sales" id="delivery_sales" class="form-control salesInputs" type="number" step="0.01" value="" required> 
                    <div id="saleSumTotal">
                        <!--total filled dynamically by JS-->
                    </div>    
                </div>
            </div>

            <div>
                <!--<label>
                    <input name="btn_insertSales" class="btn btn-primary" type="submit" id="insertSales_Button" value="Insert" value="" readonly>
                </label>-->
                <!--for update queries on current record selected-->
                <input type = "hidden" name="transactionID" id="transactionID" /> 
                <!--Button text updated by AJAX and calls different queries-->
                <button type="button" name="action" id="action" class="btn btn-warning">INSERT</button>
            </div>
        <!--</form>-->
    </div>
    <br />
    <br />
    <div class="row">
        <div class="col-md-10 col-centered">
            <div id="resultsTable" class="table-responsive">
            <!--display sales table here with JavaScript-->
            </div>
        </div>
    </div>
</section>

<!--============= FOOTER section=============-->
<!--========================================-->
<?php
if (__DEBUG==TRUE) //construct the footer with debug information 
	{	
		$contentStringFOOTER.= '<footer class="debug copyright">';

		$contentStringFOOTER.=  '<h3>***DEBUG INFORMATION***</h3>';
		
		$contentStringFOOTER.=  '<h4>$_COOKIE Array</h4>';
		foreach($_COOKIE as $key=>$value){
			$contentStringFOOTER.=  '$_COOKIE[\''.$key."'] = ".$value.'</br>';
		}
		
		$contentStringFOOTER.=  '<h4>$_SESSION Array</h4>';
		foreach($_SESSION as $key=>$value){
			$contentStringFOOTER.=  '$_SESSION[\''.$key."'] = ".$value.'</br>';
		}		

		$contentStringFOOTER.=  '<h4>$_POST Array</h4>';
		foreach($_POST as $key=>$value){
			$contentStringFOOTER.=  '$_POST[\''.$key."'] = ".$value.'</br>';
		}
		
        echo "<br/>";
        print_r($_POST);

		if(isset($sql)){
			$contentStringFOOTER.=  '<h4>SQL QUERY</h4>';
			$contentStringFOOTER.= $sql;
		}

		$contentStringFOOTER.=  "</footer>";
        echo $contentStringFOOTER;
	}
?>
<!-- JAVASCRIPT / JQUERY -->
<?php include('inc/tail.php'); ?>

<script> 
$(document).ready(function(){ //called on webpage load

    // SALES functions in 'scripts.js'
    totalSales(); //get sum of values in input fields   
    fetchSales(); //fetch Sales from Database and display in Table
    
    /*====================================================
    * (2) INSERT Sales function
    * JQuery handles form data
    * INSERT SALES using stored procedure: CALL 'insert_weekly_sales'
    * inserts into 'weekly_sales_itemised' (this doesn't have Totals column)
    * requires: [saleDate][dineInSales][takeOutSales][deliverySales]
    * NB makes sure picked Date is reformatted to YYYY-MM-DD with 'moment.js'
    * ref: http://stackoverflow.com/questions/5004233/jquery-ajax-post-example-with-php 
    * ref: http://callbackhell.com/
    * ref: About JQuery's callback functions: http://stackoverflow.com/questions/22213495/jquery-post-done-and-success
    ====================================================*/
    // Variable to hold request
    var request;
    $('#action').click( function(){

        // Prevent default posting of form - put here in case of errors
        event.preventDefault();

        // Abort any pending request
        if (request) { request.abort(); }

        // setup some local variables
        var $form = $(this);
        var action = $('#action').text();

        //var transactionID = $('#transactionID').val();
        var unformattedSaleDate = $('#sale_date').val(); //not the right format for mysql
		var sale_date = moment(unformattedSaleDate, "DD/MM/YYYY").format('YYYY-MM-DD');
		// console.log("date picked: " + unformattedSaleDate);
		console.log("date on insert: " + sale_date);

        var dineIn_sales = $('#dineIn_sales').val();
        var takeOut_sales = $('#takeOut_sales').val();
        var delivery_sales = $('#delivery_sales').val();

        // select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");

        // Serialize the data in the form
        var postSerialisedData = $("#formSales").serialize();

        if( (sale_date!='') && (dineIn_sales!='') && (takeOut_sales!='') && (delivery_sales!='') ) {
            // Let's disable the inputs for the duration of the Ajax request.
            // Note: we disable elements AFTER the form data has been serialized.
            // Disabled form elements will not be serialized.
            $inputs.prop("disabled", true);

            // Fire off the request to insertSales.php
            request = $.ajax({
                url: "modules/sales/actionSales.php",   // AJAX request
                type: "POST", //POST method to send data to server
                data: postSerialisedData
            });               
            
            // Callback handler that will be called on success
            request.done( function(response, textStatus, jqXHR){
                 // Log a message to the console
                console.log("Hooray, it worked!");
                console.log(postSerialisedData);
                fetchSales(); //update the table in View
            });

            // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown){
                // Log the error to the console
                console.error(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            });

            // Callback handler that will be called regardless
            // if the request failed or succeeded
            request.always(function () {
                // Re-enable the inputs
                $inputs.prop("disabled", false);
            });

            // getting unexpected token ; error...
            // $.ajax({
            //     url: "modules/sales/actionSales.php",   // AJAX request
            //     type:"POST", //POST method to send data to server
            //     data:{
            //         sale_date: sale_date, 
            //         dineIn_sales: dineIn_sales, 
            //         takeOut_sales: takeOut_sales, 
            //         delivery_sales: delivery_sales
            //     },
            //     data: postDataString
            //     success:function(data){
            //         alert(data);
            //         alert(data.code);
            //         console.log(data);
            //         fetchSales();
            //     }
            // }); //end AJAX

            // possibly useful, JQuery's .post() method instead?
            // postData = $('#formSales').serialize();
            // $.post('modules/sales/actionSales.php', postData+'&action&ajaxrequest=1',function(message){
            //     if(message){
            //         $('#formSales').before(message);
            //     }
            // });

        } else{
            $inputs.prop("disabled", false);
            console.log('Input fields cannot be empty');
            alert('Please fill in all the input fields');
        }  
    }); // end insertSales clicked
    
    /*====================================================
    * (3) UPDATE SALES function
    * UPDATE SALES using stored procedure: CALL 'insert_weekly_sales'
    ====================================================*/
    $(document).on('click','.update',function(){
        var id = $(this).attr("id");
        $.ajax({
            url: "modules/sales/updateSales.php",
            method: "POST",
            data: {id:TransactionID},
            dataType: "json", // the type we will receive from server
            success:function(data){ //success callback, stores what is received from server under 'data'
                $('#action').text("UPDATE"); //change button text from INSERT to UPDATE
                $("#transactionID").val(id); //assign id variable to hidden field
                $("#sale_date").val(data.SaleDate);
                $("#dineIn_sales").val(data.DineIneSales);
                $("#takeOut_sales").val(data.TakeOutSales);
                $("#delivery_sales").val(data.DeliverySales);
            }
        })
    }); // end UPDATE function


    /*====================================================
    * (4) Morris Charts function
    ====================================================*/

}); //end document ready
</script>

</body>
</html>