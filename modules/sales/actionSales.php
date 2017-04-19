<?php
// include_once("config/connection.php");  //include the database connection 
// include_once("config/config.php");  //include the application configuration settings

$conn = mysqli_connect("localhost", "root", "root", "luckycat");  
//=====================
// check connection
//=====================
if ( $conn->connect_error ) {
	if (__DEBUG==TRUE) {
		echo "<p>Database connection failed: $conn->connect_error, E_USER_ERROR </p>";
	}
	else{
		header("Location: error.php"); /* Redirect browser */
		/* Make sure that code below does not get executed when we redirect. */
		exit;
	}
	exit("<p>PHP script terminated. Database connection failed</p>");
} else{
    if($conn){ //database connect successful
        if (__DEBUG==TRUE) {
            echo "<p>Database Connected</p>";
            print_r($conn);
        }
    }
}
// end check conneciton
//=====================

echo "<h3>action button function loaded</h3>";
// =====================
// 		ACTION button
// =====================
$output = '';

if( isset($_POST["action"]) ){ // 'action' button is pressed on insertSales form
    
    // =====================
    // 		INSERT action button
    // =====================
    if($_POST["action"] == "INSERT"){
        //INSERT QUERY : get the values entered in the form
        $salesTransactionIDAUTO = ''; // or NULL, for auto increment TransactionID
        
        if (isset($_POST['transactionID'])) { $transactionID =  mysqli_real_escape_string($conn, $_POST['transactionID']);  } else{ $transactionID = ''; }
        if (isset($_POST['sale_date'])) { $saleDate =           mysqli_real_escape_string($conn, $_POST['sale_date']);      } else{ $saleDate = ''; }
        if (isset($_POST['dineIn_sales'])) { $dineSales =       mysqli_real_escape_string($conn, $_POST['dineIn_sales']);   } else{ $dineSales = ''; }
        if (isset($_POST['takeOut_sales'])) { $takeSales =      mysqli_real_escape_string($conn, $_POST['takeOut_sales']);  } else{ $takeSales = ''; }
        if (isset($_POST['delivery_sales'])) { $deliverSales =  mysqli_real_escape_string($conn, $_POST['delivery_sales']); } else{ $deliverSales = ''; }

        // Input form enters into columns: [SaleDate][TotalSales][DineInSales][TakeOutSales][DeliverySales]

        // reformat the date for MySQL
        // $dateUnformatted = strtotime($saleDate);
        $dateParts = explode('-', $saleDate); // to reformat from 'DD-MM-YYYY'
        $mysqlDate = "$dateParts[2]-$dateParts[1]-$dateParts[0]"; // to 'YYYY-MM-DD'
        
        // a) 'INSERT Sales' query
        // $sqlInsert = "INSERT INTO weekly_sales_itemised VALUES( '','".$mysqlDate."','".$dineSales."','".$takeSales."','".$deliverSales."')";
        
        // b) call 'INSERT Sales' Stored Procedure ([ID = 0(auto incremented)] [SaleDate] [DineInSales] [TakeOutSales] [DeliverySales])
        $sqlInsert = "CALL insert_weekly_sales('".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."')";
        
        $requesttype = $_POST['requesttype'];
        $ajaxrequest = $_POST['ajaxrequest'];

        // JSON object with form data in associative array
        $formdata = array(
            'saleDate' => $saleDate,
            'dineSales' => $dineSales,
            'takeSales' => $takeSales,
            'deliverSales' => $deliverSales
        );

        //=====================
        //execute the INSERT query
        //=====================
        if( mysqli_query($conn,$sqlViewQuery )==TRUE ) { //insert Sales
            $msg .= "<h3>New data inserted successfully</h3>";
            $result = mysqli_query($conn,$sqlInsert); // store View in result variable
            echo 'Data inserted';
            
            $output .= '
                <table class="<table table-bordered">
                    <tr>
                        <th width="15%">TransactionID</th>
                        <th width="15%">Date</th>
                        <th width="23%">Dine In Sales</th>
                        <th width="23%">Take Out Sales</th>
                        <th width="23%">Delivery Sales</th>
                    </tr>
            ';
            if( mysqli_num_rows($result) > 0 ) {
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
                } //end while
                print_r($result);
            } else {
                $msg.=  "<h3>New data has not been inserted - a record for this ID already exists</h3>";
                $output .= '
                    <tr>
                        <td colspan = "4">Data not Found</td>
                    </tr>
                ';
            }
            $output .= '</table>';
            echo $output;
        } //end if INSERT and Fetch query executed
        echo "<h3>end action button function executed</h3>";
    } // end POST action INSERT

    // =====================
    // UPDATE action button
    // =====================
     if($_POST["action"] == "UPDATE"){
        if (isset($_POST['transactionID'])) { $transactionID =  mysqli_real_escape_string($conn, $_POST['transactionID']);  } else{ $transactionID = ''; }
        if (isset($_POST['sale_date'])) { $saleDate =           mysqli_real_escape_string($conn, $_POST['sale_date']);      } else{ $saleDate = ''; }
        if (isset($_POST['dineIn_sales'])) { $dineSales =       mysqli_real_escape_string($conn, $_POST['dineIn_sales']);   } else{ $dineSales = ''; }
        if (isset($_POST['takeOut_sales'])) { $takeSales =      mysqli_real_escape_string($conn, $_POST['takeOut_sales']);  } else{ $takeSales = ''; }
        if (isset($_POST['delivery_sales'])) { $deliverSales =  mysqli_real_escape_string($conn, $_POST['delivery_sales']); } else{ $deliverSales = ''; }
     }

} // end isset 'action'


?>