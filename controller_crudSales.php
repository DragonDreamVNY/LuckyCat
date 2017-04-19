<?php
//============================
//Start/join a session
//this must come BEFORE the <HTML> tag
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//initialise session variable used by the controller
//if(!isset($_SESSION['sales_TransactionID'])){ $_SESSION['sales_TransactionID'] = 'VALID ID NOT SELECTED';}

//includes
include_once("config/connection.php");  //include the database connection 
include_once("config/config.php");  //include the application configuration settings

//views
include_once("library/helperFunctionsDatabase.php");
include_once("library/helperFunctionsTables.php");

// if( isset($_POST["action"]) ){
//             //INSERT QUERY
//             //get the values entered in the form
//             $salesTransactionIDAUTO = 0;
//             $saleDate=$conn->mysqli_real_escape_string($_POST['sale_DatePicked']);
//             $dineSales=$conn->mysqli_real_escape_string($_POST['dine_Sales']);
//             $takeSales=$conn->mysqli_real_escape_string($_POST['take_Sales']);
//             $deliverSales=$conn->mysqli_real_escape_string($_POST['deliver_Sales']);	
//             // Input form enters into columns: [SaleDate][TotalSales][DineInSales][TakeOutSales][DeliverySales]

//             // reformat the date for MySQL
//             // $dateUnformatted = strtotime($saleDate);
//             $dateParts = explode('-', $saleDate); // to reformat from 'DD-MM-YYYY'
//             $mysqlDate = "$dateParts[2]-$dateParts[1]-$dateParts[0]"; // to 'YYYY-MM-DD'

//             // call 'INSERT Sales' Stored Procedure
//             // $sqlInsert = "INSERT INTO weeklysales_itemised VALUES('".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."')";
//             $sqlInsert = "CALL insert_weekly_sales('".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."')";

//             // "VIEW weekly sales" with Total. 
//             //$sqlViewQuery = "SELECT * FROM weekly_sales_total";
//             $sqlViewQuery = "CALL view_weekly_sales()";

//             //execute the INSERT query
//             if( mysqli_query($conn,$sqlViewQuery )==TRUE ) { //insertedSales
//                 //$msg.= "<h3>New data inserted successfully</h3>";
//                 $result = mysqli_query($conn,$sqlViewQuery); // store view in result
//                 $output .= '
//                     <table class="<table table-bordered">
//                         <tr>
//                             <th width="35%">TransactionID</th>
//                             <th width="35%">Date</th>
//                             <th width="35%">Dine In Sales</th>
//                             <th width="35%">Take Out Sales</th>
//                             <th width="35%">Delivery Sales</th>
//                         </tr>
//                 ';
//                 if( mysqli_num_rows($result)>0 ) {
//                     while( $row = mysqli_fetch_array($result) ){
//                         $output .= ' 
//                             <tr>
//                                 <td>'.$row["TransactionID"].'</td>
//                                 <td>'.$row["SaleDate"].'</td>
//                                 <td>'.$row["TotalSales"].'</td>
//                                 <td>'.$row["DineInSales"].'</td>
//                                 <td>'.$row["TakeOutSales"].'</td>
//                                 <td>'.$row["DeliverySales"].'</td>
//                                 <td><button type="button" name="updateSales" id="'.$row["TransactionID"].'" class="updateSales">UPDATE</button></td>
//                                 <td><button type="button" name="deleteSales" id="'.$row["TransactionID"].'" class="deleteSales">DELETE</button></td>
//                             </tr>
//                         ';
//                     }
//                     //print_r($row);
//                 } else {
//                     $output .= '
//                         <tr>
//                             <td colspan = "4">Data not Found</td>
//                         </tr>
//                     ';
//                 }
//                 $output .= '</table>';
//                 echo $output;
//             }
//             else {
//                 $msg.=  "<h3>New data has not been inserted - a record for this ID already exists</h3>";
//             }
//         }
// end ACTION BUTTON

//include_once("library/actionforSales.php");
// include("modules/sales/model_crudSales.php");
// include("modules/sales/view_crudSales.php");
include("modules/sales/crudSales.php");

// if(isset($_POST['btn_select_for_deletion'])){ //load the record delete controller		
// 			include('controller_deleteSales.php');
// }			
// elseif(isset($_POST['btn_edit'])){ //load the record edit controller
// 			include("controller_editSales.php");
// }		
// else{//load the edit/delete form model and view
// 	include("library/helperFunctionsDatabase.php");
// 	include("library/helperFunctionsTables.php");
// 	include("modules/sales/model_updateSales.php");
// 	include("modules/sales/views_updateSales.php");
// }

?>