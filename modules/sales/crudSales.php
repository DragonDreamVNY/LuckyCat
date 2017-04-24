<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
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
    <?php echo "<p> Welcome : $userRole </p>"; ?> 
</header>

<!--============= NAVIGATION section=============-->
<!--========================================-->
<nav>
<!--<?php include("inc/nav.php"); ?>-->

<?php
// ADMIN or MANAGER
if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='admin') || ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='manager') ) {
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
				</ul>	
			</div>
		</div>';
}
// MARKETING
else if( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='marketer') ) {
	//nav section content - logged in user
	// $contentStringNAV='<header id="SiteHeader" class = "header">';
	$contentStringNAV.= "<h2>Welcome $userFirstName</h2>";
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
	$contentStringNAV.= 	'<div class="container">';
	$contentStringNAV.= 		'<div class="navbar-header">';
	$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
	$contentStringNAV.= 	'</div>';

	$contentStringNAV.= 	'<ul class="nav navbar-nav">';
	$contentStringNAV.= 		'<li"><a href="index.php">Home</a></li>';
	$contentStringNAV.= 		'<li class="active"><a href="controller_performance.php">Performance View</a></li>';
	$contentStringNAV.= 		'<li><a href="controller_charms.php">Lucky Charms</a></li>';
	$contentStringNAV.= 	'</ul>';	
	$contentStringNAV.= 	'</div>';
	$contentStringNAV.= '</div>';
	// $contentStringNAV.= '</header>';
}
// ACCOUNTANT
else if ( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='accountant') ) {
	//nav section content - logged in user
	// $contentStringNAV='<header id="SiteHeader" class = "header">';
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
	$contentStringNAV.= 	'<div class="container">';
	$contentStringNAV.= 		'<div class="navbar-header">';
	$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
	$contentStringNAV.= 	'</div>';

	$contentStringNAV.= 	'<ul class="nav navbar-nav">';
	$contentStringNAV.= 		'<li><a href="index.php">Home</a></li>';
	$contentStringNAV.= 		'<li class="active"><a href="controller_sales.php">Sales</a></li>'; //sales main page
	$contentStringNAV.= 		'<li><a href="controller_performance.php">Performance View</a></li>';
	$contentStringNAV.= 	'</ul>';	
	$contentStringNAV.= 	'</div>';
	$contentStringNAV.= '</div>';
	// $contentStringNAV.= '</header>';

}
else{
	//nav section content - not logged in
	$contentStringNAV='';
	$contentStringNAV.='You Are NOT LOGGED IN boo';
	$contentStringNAV.='<a href="controller_main.php">HOME</a></br>';
}
echo $contentStringNAV;
echo $msg;
?>


</nav>


<!--============= MAIN section=============-->
<!--========================================-->
<section>
    <div class ="container box">  
        <h3>Sales Insert/Update</h3>
        <br/>
        <!--<button type="button" name="add" class="btn btn-success" data-toggle="collapse" data-target="#sales_collapse">Add</button>-->
        <!--<div id="sales_collapse" class="collapse">-->

            <form method="post" id="formSales" class="form-inline" autocomplete="on">
                
                <!--**** DATE PICKER *****-->
                <div class="col-md-12">
                    
         
                    <div class="date form-group" id="datetimepicker1">
                        <label for "sale_date">Pick Date</label>
                        <input name="sale_date" id="sale_date" type="text" class="form-control" required>
                    </div>
       
                    <!--<div id="output"></div>
                    <div id="outputTest"></div>
                    <div id="output2"></div>
                    <div id="output3"></div>
                    <div id="output4"></div>
                    <div id="output5"></div>-->
                    
                </div>
                <!--**** end date picker: see JavaScript for settings ****-->

                <div id = "saleValues" class="form-inline"> 
                    <div class="form-group">
                        <label for "dineIn_sales"> DineIn: €</label>
                        <input name="dineIn_sales" id="dineIn_sales"  class="form-control salesInputs" type="number" step="0.10" value="" required>
                        <br>
                        <label for "takeAway_sales">TakeOut: €</label>
                        <input name="takeAway_sales" id="takeAway_sales" class="form-control salesInputs" type="number" step="0.10" value="" required>     
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
                    <input type = "hidden" name="action" id="action" /> 
                    <!--Button text updated by AJAX and calls different queries-->
                    <input type="submit" name="button_action" id="button_action" class="btn btn-warning" value="INSERT">
                    <img src="images/loading.gif" id="LoadingImage" style="display:none" />
                    <!--<button type="submit" name="action" id="action" class="btn btn-warning">INSERT</button>-->
                </div>
            </form>     
        <!--</div>-->
        <!--end collapse-->
    </div>
    <div class="row">
        <div class="col-md-10 col-centered">

            <div id="resultsTable" class="table-responsive">
                <!--display sales table here with PHP, called from JavaScript-->
                <!--*********from 'select.php'**************-->
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
//called on webpage load
$(document).ready(function(){

    // SALES functions in 'scripts.js'
    totalSales(); //get sum of values in input fields   
    loadSales(); //fetch Sales from Database and display in Table
    
    

    /*==============================================
                    INSERT SALES
    ==========================================*/
    /*====================================================
    * (2) INSERT Sales function
    * JQuery handles form data
    * INSERT SALES using stored procedure: CALL 'insert_weekly_sales'
    * inserts into 'weekly_sales_itemised' (this doesn't have Totals column)
    * form input values: [saleDate][dineInSales][takeOutSales][deliverySales]
    * NB makes sure picked Date is reformatted to YYYY-MM-DD with 'moment.js'
    * ref: http://stackoverflow.com/questions/5004233/jquery-ajax-post-example-with-php 
    * ref: http://callbackhell.com/
    * ref: About JQuery's callback functions: http://stackoverflow.com/questions/22213495/jquery-post-done-and-success
    * ref: Callbacks and Promises:  http://api.jquery.com/jquery.ajax/ 
    ====================================================*/

    var ajaxRequest;  // The variable that makes Ajax possible!
    // Browser Support Code
    function ajaxFunction(){
        

        try{
            // Opera 8.0+, Firefox, Safari
            ajaxRequest = new XMLHttpRequest();
        }catch (e){
        // Internet Explorer Browsers
            try{
                ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
            }catch (e) {
                try{
                    ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                }catch (e){
                    // Something went wrong
                    alert("Your browser broke!");
                    return false;
                }
            }
        } 
    } // END AJAX CHECK

    // on the click of the submit button ('INSERT')
    // 'actionSales' php file will handle the INSERT / UPDATE depending on value of $_POST['button_action'] 
    $( "#formSales" ).submit(function( event ) {
        var $submitButtonClickedMSG = $('#button_action').val();
        console.log("action button is : " + $submitButtonClickedMSG);
        //alert($submitButtonClickedMSG);
        event.preventDefault();     // Prevent default posting of form
        // if (ajaxRequest) { ajaxRequest.abort(); }   // Abort any pending request
       
       // get form values
        var $form = $(this);
        // var action = $('#action').text();

        var unformattedSaleDate = $('#sale_date').val();    //not the right format for mysql
        var sale_date = moment( unformattedSaleDate, "DD/MM/YYYY" ).format('YYYY-MM-DD');
        // console.log("date picked: " + unformattedSaleDate);
        console.log( "date on insert: " + sale_date );

        var dineIn_sales = $('#dineIn_sales').val();
        var takeAway_sales = $('#takeAway_sales').val();
        var delivery_sales = $('#delivery_sales').val();

        // select and cache all the fields
        var $inputs = $form.find( "input, select, button, textarea" );

        // var postSerialisedData = $("#formSales").serialize();
        // var inputData = $( "#formSales :input" ).serializeArray();
        // console.log(data);      //use the console for debugging, F12 in Chrome, not alert

        var inputData={
             sale_date:sale_date,
             dineIn_sales:dineIn_sales,
             takeAway_sales:takeAway_sales,
             delivery_sales:delivery_sales
        };
        
        /* Disable the inputs for the duration of the Ajax request.
         * Note: we disable elements AFTER the form data has been serialized.
         * Disabled form elements will not be serialized.*/
        // $inputs.prop( "disabled", true );

        $("#button_action").hide(); //hide submit button
        $("#LoadingImage").show(); //show loading image
        

        if( (sale_date!='') && (dineIn_sales!='') && (takeAway_sales!='') && (delivery_sales!='') ) {
            
            ajaxRequest = $.ajax({
                url: "modules/sales/actionSales.php",       // AJAX request
                type: "POST",       //POST method to send data to server
                data: inputData
            });
            
            // Callback handler that will be called on success
            ajaxRequest.done( function(response, textStatus, jqXHR){
                 // Log a message to the console
                console.log("Hooray, it worked!");
                console.log(inputData);
                $('#sale_date').val();
                $('#dineIn_sales').val('');
                $('#takeAway_sales').val('');
                $('#delivery_sales').val(''); 
                $("#LoadingImage").hide(); //hide loading image
                $('#button_action').val('INSERT'); // change button back to INSERT, if it was UPDATE
                $("#button_action").show(); //show submit button
                loadSales(); //update the table in View
            });


            // Callback handler that will be called on failure
            ajaxRequest.fail( function(jqXHR, textStatus, errorThrown){
                $("#LoadingImage").hide(); //hide loading image
                $("#button_action").show(); //show submit button
                // Log the error to the console
                console.error( "The following error occurred: "+ textStatus, errorThrown );
                alert(thrownError);
            });
            
            // Callback handler that will be called regardless if the request failed or succeeded
            ajaxRequest.always( function () {
                // Re-enable the inputs
                $inputs.prop("disabled", false);
            });
        } else{ alert( "Please fill in all the fields" ); }
 
    }); //end INSERT SALES



    /*==============================================
                    DELETE SALES
    ==========================================*/
    //##### Send DELETE Ajax request to response.php #########
	$("body").on("click", "#resultsTable .delSales_button", function(event) {
		 event.preventDefault();
		 var clickedID = this.id.split('-'); // Split ID string (Split works as PHP explode)
		 var TransactionID = clickedID[1];  // and get number from array . Use this to select entire row <tr>
		 var myData = 'recordToDelete='+ TransactionID; //build a post data structure
		 
		$('#salesRow_'+TransactionID).addClass( "selectedRow" ); //change background of this element by adding class
		$(this).hide(); //hide currently clicked delete button
		 
			$.ajax({
                type: "POST",   // HTTP method POST or GET
                url: "modules/sales/actionSales.php",  //Where to make Ajax calls
                dataType:"text",    // Data type, HTML, json etc.
                data:myData,    //Form variables
                success:function(response){
                    //on success, hide  element user wants to delete.
                    $('#salesRow_'+TransactionID).fadeOut();
                    console.log("sales Row deleted");
                },
                error:function (xhr, ajaxOptions, thrownError){
                    //On error, we alert user
                    alert(thrownError);
                }
			});
	}); // end DELETE SALES ROW



    /*==============================================
                    UPDATE SALES
    ==========================================*/
    $("body").on("click", "#resultsTable .updateSales_button", function(event) {
        var $submitButtonClickedMSG = $('#button_action').val();
        console.log("action button is : " + $submitButtonClickedMSG);
        event.preventDefault();
        var clickedID = this.id.split('-'); // Split ID string (Split works as PHP explode)
        var TransactionID = clickedID[1];  // and get number from array . Use this to select entire row <tr>
        var action = "Fetch Single Row";

        // get form values
        var $form = $(this);
        // var action = $('#action').text();

        // select and cache all the fields
        var $inputs = $form.find( "input, select, button, textarea" );

        var updateData={
            TransactionID:TransactionID,
            action:action
        };
		$('#button_action').val('UPDATE'); //
		$('#salesRow_'+TransactionID).addClass( "selectedRow" ); //change background of this element by adding class
    
        $.ajax({
            url: "modules/sales/actionSales.php",
            method: "POST",  
            data:updateData, 
            dataType:"json", 
            success:function(data)
            {
                console.log("Preparing to Update...");
                // load the selected row's details into form for Editing
                $('#sale_date').val(data.sale_date);
                $('#dineIn_sales').val(data.dineIn_sales);
                $('#takeAway_sales').val(data.takeAway_sales);
                $('#delivery_sales').val(data.delivery_sales); 
                $("#LoadingImage").hide(); //hide loading image
                $('#button_action').val('UPDATE'); // change button to UPDATE
                $("#button_action").show(); //show submit button
                $('#TransactionID').val(TransactionID);
            },
            error:function (xhr, ajaxOptions, thrownError){
                //On error, we alert user
                alert(thrownError);
            }
        }); //end ajax
	}); // end UPDATE SALES


}); //end document ready



</script>


</body>
</html>