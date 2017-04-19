<?php
//insert SALES call Stored Procedure

$table='sales';  //table to insert values into
	
//INSERT QUERY
//get the values entered in the form
// $salesTransactionIDAUTO = '';
// $saleDate = $conn->real_escape_string($_POST['sale_date']);
// $dineSales = $conn->real_escape_string($_POST['dine_Sales']);
// $takeSales = $conn->real_escape_string($_POST['takeOut_sales']);
// $deliverSales = $conn->real_escape_string($_POST['delivery_sales']);	

if (isset($_POST['transactionID'])) { $transactionID = 	mysqli_real_escape_string($conn, $_POST['transactionID']); } else{ $transactionID = ''; }
if (isset($_POST['sale_date'])) { $saleDate = 			mysqli_real_escape_string($conn, $_POST['sale_date']); } 	 else{ $saleDate = ''; }
if (isset($_POST['dineIn_sales'])) { $dineSales = 		mysqli_real_escape_string($conn, $_POST['dineIn_sales']); }  else{ $dineSales = ''; }
if (isset($_POST['takeOut_sales'])) { $takeSales = 		mysqli_real_escape_string($conn, $_POST['takeOut_sales']); } else{ $takeSales = ''; }
if (isset($_POST['delivery_sales'])) { $deliverSales = 	mysqli_real_escape_string($conn, $_POST['delivery_sales']); }else{ $deliverSales = ''; }

//$dateUnformatted = strtotime($saleDate);
//$mysqlDate = date( 'Y-m-d', $saleDate );

$dateParts = explode('-', $saleDate); // to reformat from 'DD-MM-YYYY'
$mysqlDate = "$dateParts[2]-$dateParts[1]-$dateParts[0]"; // to 'YYYY-MM-DD'

/*=================================
/ call insert Sales Stored Procedure
=================================*/
// $sqlInsert = "INSERT INTO sales (sales_TransactionID, sales_Date, dineIn_Sales, takeAway_Sales, delivery_Sales) VALUES('', '".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."' )";
// $sqlInsert = "INSERT INTO weekly_sales_itemised VALUES('', '".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."' )";
$sqlInsert = "CALL insert_weekly_sales('".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."')";

//execute the INSERT query
if(mysqli_query($conn,$sqlInsert)==TRUE) { // this actually executes ths query
    $msg.= "<h3>SUCCESS: New data inserted</h3>";

}
else {
    $msg.=  "<h3>FAILED: New data NOT inserted</h3>";
}

//prepare the result of the insertion for display in a view

//Query string
// $sqlData="SELECT * FROM $table WHERE LectID='$lectID'";  //get the data from the table
// $sqlTitles="SHOW COLUMNS FROM $table";  //get the table column descriptions

// //execute the 2 queries
// $rsTitles = getTableData($conn,$sqlTitles);
// $rsData = getTableData($conn,$sqlData);


// //check the results 
// $arrayData=checkResultSet($rsData);
// $arrayTitles=checkResultSet($rsTitles);

// //close the connection
// $conn->close();

/*=================================
/ end  insert Sales Stored Procedure
=================================*/


//-----------------------------------------------------
//prepare view template values
$pageHeading='Insert Sales Results';

// =====================
// 		NAVIGATION
// =====================
//nav section content - logged in user
// $contentStringNAV='<header id="SiteHeader" class = "header">';
if ($_SESSION['loggedin']==TRUE){
	//$msg='Well...You are Logged In';
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
	$contentStringNAV.= 	'<div class="container">';
	$contentStringNAV.= 		'<div class="navbar-header">';
	$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
	$contentStringNAV.= 	'</div>';

	$contentStringNAV.= 	'<ul class="nav navbar-nav">';
	$contentStringNAV.= 		'<li><a href="index.php">Home</a></li>';
	$contentStringNAV.= 		'<li class="active"><a href="controller_sales.php">Sales</a></li>';
	$contentStringNAV.= 		'<li><a href="modules/performance//view_kpi.php">Performance View</a></li>';
	$contentStringNAV.= 		'<li><a href="modules/luckycharms/luckycharms.php">Lucky Charms</a></li>';
	$contentStringNAV.= 		'<li><a href="controller_login_manager.php">RELOAD</a></li>';
	$contentStringNAV.= 	'</ul>';	
	$contentStringNAV.= 	'</div>';
	$contentStringNAV.= '</div>';
// $contentStringNAV.= '</header>';
}
else{
	//nav section content - not logged in
	$contentStringNAV='';
	$contentStringNAV.='You Are NOT LOGGED IN';
	$contentStringNAV.='<a href="controller_main.php">HOME</a></br>';
    
    $msg='Not Logged In';
}

// =====================
// 		MAIN
// =====================
//main section content:
$contentStringMAIN="<h4>$contentStringMAIN message from Model insertSalesRESULT</h4>";
$contentStringMAIN.='
<div>
	<h3>Your inputs</h3>
	<p>'.$salesTransactionIDAUTO.'</p>
	<p>'.$mysqlDate.'</p>
	<p>'.$dineSales.'</p>
	<p>'.$takeSales.'</p>
	<p>'.$deliverSales.'</p>
</div>';

// =====================
// 		FOOTER
// =====================
$contentStringFOOTER='';


if (__DEBUG==TRUE) //construct the footer with debug information 
{	
        $contentStringFOOTER.= '<footer class="debug copyright">';
        $contentStringFOOTER.= '<div class ="container">';
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

        if(isset($sql)){
                $contentStringFOOTER.=  '<h4>SQL QUERY</h4>';
                $contentStringFOOTER.= $sql;
        }
        $contentStringFOOTER.= '</div>';
		$contentStringFOOTER.= '<div class ="cold-md-12">';
		$contentStringFOOTER.= '<div class = "col-md-offset-1">';
        $contentStringFOOTER.= 		'Copyright 2017 Vincent Lee';
		$contentStringFOOTER.= '</div>';
		$contentStringFOOTER.= '</div>';
        $contentStringFOOTER.=  "</footer>";
}
else{ //construct the standard footer
	$contentStringFOOTER.='<footer class="copyright">';
	$contentStringFOOTER.= 'Copyright 2017 Vincent Lee';
	$contentStringFOOTER.= "</footer>";
}

?>