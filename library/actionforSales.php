<?php
//echo "<h3>action button function loaded</h3>";
// =====================
// 		ACTION button
// =====================
function actionButton(){
    try {
        if( isset($_POST["action"]) ){
            //INSERT QUERY
            //get the values entered in the form
            $salesTransactionIDAUTO = 0;
            $saleDate=$conn->mysqli_real_escape_string($_POST['sale_DatePicked']);
            $dineSales=$conn->mysqli_real_escape_string($_POST['dine_Sales']);
            $takeSales=$conn->mysqli_real_escape_string($_POST['take_Sales']);
            $deliverSales=$conn->mysqli_real_escape_string($_POST['deliver_Sales']);	
            // Input form enters into columns: [SaleDate][TotalSales][DineInSales][TakeOutSales][DeliverySales]

            // reformat the date for MySQL
            // $dateUnformatted = strtotime($saleDate);
            $dateParts = explode('-', $saleDate); // to reformat from 'DD-MM-YYYY'
            $mysqlDate = "$dateParts[2]-$dateParts[1]-$dateParts[0]"; // to 'YYYY-MM-DD'

            // call 'INSERT Sales' Stored Procedure
            // $sqlInsert = "INSERT INTO weeklysales_itemised VALUES('".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."')";
            $sqlInsert = "CALL insert_weekly_sales('".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."')";

            // "VIEW weekly sales" with Total. 
            //$sqlViewQuery = "SELECT * FROM weekly_sales_total";
            $sqlViewQuery = "CALL view_weekly_sales()";

            //execute the INSERT query
            if( mysqli_query($conn,$sqlViewQuery )==TRUE ) { //insertedSales
                //$msg.= "<h3>New data inserted successfully</h3>";
                $result = mysqli_query($conn,$sqlViewQuery); // store view in result
                $output .= '
                    <table class="<table table-bordered">
                        <tr>
                            <th width="35%">TransactionID</th>
                            <th width="35%">Date</th>
                            <th width="35%">Dine In Sales</th>
                            <th width="35%">Take Out Sales</th>
                            <th width="35%">Delivery Sales</th>
                        </tr>
                ';
                if( mysqli_num_rows($result)>0 ) {
                    while( $row = mysqli_fetch_array($result) ){
                        $output .= ' 
                            <tr>
                                <td>'.$row["TransactionID"].'</td>
                                <td>'.$row["SaleDate"].'</td>
                                <td>'.$row["TotalSales"].'</td>
                                <td>'.$row["DineInSales"].'</td>
                                <td>'.$row["TakeOutSales"].'</td>
                                <td>'.$row["DeliverySales"].'</td>
                                <td><button type="button" name="updateSales" id="'.$row["TransactionID"].'" class="updateSales">UPDATE</button></td>
                                <td><button type="button" name="deleteSales" id="'.$row["TransactionID"].'" class="deleteSales">DELETE</button></td>
                            </tr>
                        ';
                    }
                    //print_r($row);
                } else {
                    $output .= '
                        <tr>
                            <td colspan = "4">Data not Found</td>
                        </tr>
                    ';
                }
                $output .= '</table>';
                echo $output;
            }
            else {
                $msg.=  "<h3>New data has not been inserted - a record for this ID already exists</h3>";
            }
        }
    } catch(Exception $e) {
		if (__DEBUG==TRUE){ 
			echo 'Message: ' .$e->getMessage();
			print_r($sqlViewQuery);
			exit('<p class="warning">PHP script terminated');
		}
		else{	
			header("Location:".__USER_ERROR_PAGE);
		}
	}
}
?>