<?php
$table='sales';  //table to insert values into

include_once("config/config.php");
include_once("config/connection.php");
include_once("library/actionforSales.php");

//variables
$tab="Lucky Cat Dashboard";
$pageHeading='Insert/Update Sales Page';
$msg = '';
$output = '';
//echo "<p>Crud Model loaded</p>";

// =====================
// 		ACTION button
// =====================
// if( isset($_POST["action"]) ){
//     //INSERT QUERY
//     //get the values entered in the form
//     $salesTransactionIDAUTO = 0;
//     $saleDate=$conn->mysqli_real_escape_string($_POST['sale_DatePicked']);
//     $dineSales=$conn->mysqli_real_escape_string($_POST['dine_Sales']);
//     $takeSales=$conn->mysqli_real_escape_string($_POST['take_Sales']);
//     $deliverSales=$conn->mysqli_real_escape_string($_POST['deliver_Sales']);	
//     // Input form enters into columns: [SaleDate][TotalSales][DineInSales][TakeOutSales][DeliverySales]

//     // reformat the date for MySQL
//     // $dateUnformatted = strtotime($saleDate);
//     $dateParts = explode('-', $saleDate); // to reformat from 'DD-MM-YYYY'
//     $mysqlDate = "$dateParts[2]-$dateParts[1]-$dateParts[0]"; // to 'YYYY-MM-DD'

//     // call 'INSERT Sales' Stored Procedure
//     // $sqlInsert = "INSERT INTO weeklysales_itemised VALUES('".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."')";
//     $sqlInsert = "CALL insert_weekly_sales('".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."')";

//     // "VIEW weekly sales" with Total. 
//     //$sqlViewQuery = "SELECT * FROM weekly_sales_total";
//     $sqlViewQuery = "CALL view_weekly_sales()";

//     //execute the INSERT query
//     if( mysqli_query($conn,$sqlViewQuery )==TRUE ) { //insertedSales
//         //$msg.= "<h3>New data inserted successfully</h3>";
//         $result = mysqli_query($conn,$sqlViewQuery); // store view in result
//         $output .= '
//             <table class="<table table-bordered">
//                 <tr>
//                     <th width="35%">TransactionID</th>
//                     <th width="35%">Date</th>
//                     <th width="35%">Dine In Sales</th>
//                     <th width="35%">Take Out Sales</th>
//                     <th width="35%">Delivery Sales</th>
//                 </tr>
//         ';
//         if( mysqli_num_rows($result)>0 ) {
//             while( $row = mysqli_fetch_array($result) ){
//                 $output .= ' 
//                     <tr>
//                         <td>'.$row["TransactionID"].'</td>
//                         <td>'.$row["SaleDate"].'</td>
//                         <td>'.$row["TotalSales"].'</td>
//                         <td>'.$row["DineInSales"].'</td>
//                         <td>'.$row["TakeOutSales"].'</td>
//                         <td>'.$row["DeliverySales"].'</td>
//                         <td><button type="button" name="updateSales" id="'.$row["TransactionID"].'" class="updateSales">UPDATE</button></td>
//                         <td><button type="button" name="deleteSales" id="'.$row["TransactionID"].'" class="deleteSales">DELETE</button></td>
//                      </tr>
//                 ';
//             }
// 			print_r($row);
//         } else {
//             $output .= '
//                 <tr>
//                     <td colspan = "4">Data not Found</td>
//                 </tr>
//             ';
//         }
//         $output .= '</table>';
//         //echo $output;
//     }
//     else {
//         $msg.=  "<h3>New data has not been inserted - a record for this ID already exists</h3>";
//     }
// }
// include_once("library/actionforSales.php");

//echo "<p>Crud Model loaded, action button passed</p>";
//-----------------------------------------------------
//prepare view template values

// =====================
// 		NAVIGATION
// =====================
//nav section content - logged in user
// $contentStringNAV='<header id="SiteHeader" class = "header">';
if ($_SESSION['loggedin']==TRUE){
    
	//$msg='Well...';
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">
							<div class="container">
							<div class="navbar-header">
						 		<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>
					 		</div>
							<ul class="nav navbar-nav">
								<li><a href="index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp;Home</a></li>
						 		<li class="active"><a href="controller_sales.php">Sales</a></li>
						 		<li><a href="modules/performance//view_kpi.php">Performance View</a></li>
						 		<li><a href="modules/luckycharms/luckycharms.php">Lucky Charms</a></li>
						 		<li><a href="controller_login_manager.php">RELOAD</a></li>
						 	</ul>	
						 	</div>
						 </div>';
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
$contentStringMAIN="<h3>Insert Data PLEASE BOSS</h3>";

// =====================
// 		FOOTER
// =====================
$contentStringFOOTER='';
if (__DEBUG==TRUE) //construct the footer with debug information 
	{	
		$contentStringFOOTER.= '<footer class="debug">';

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

		$contentStringFOOTER.=  "</footer>";
	}
else{ //construct the standard footer
	// include("inc/footer.php");
	$contentStringFOOTER.='<footer class="copyright">';
	$contentStringFOOTER.= 'Copyright 2017 Vincent Lee';
	$contentStringFOOTER.= "</footer>";
}
//echo "<p>end of CRUD model</p>";
?>