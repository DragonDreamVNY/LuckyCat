<?php
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
if( isset($_POST["transactionID"]) ){ // 'action' button is pressed on insertSales form
    $output = array();
    $currentTransactionID = filter_var($_POST["transactionID"],FILTER_SANITIZE_NUMBER_INT );
    $sqlCurrentID = "call select_current_transactionid(".$currentTransactionID.")";

    //=====================
    //execute the select Current ID query
    //=====================
    if( mysqli_query($conn,$sqlCurrentID) ) {
        $msg .= "<h3>New data inserted successfully</h3>";
        $result = mysqli_query($conn,$sqlCurrentID); // store View in result variable
        echo 'Data retrieved';
        while($row = mysqli_fetch_array($result)){
            $output['SaleDate'] = $row['SaleDate'];
            $output['TotalSales'] = $row['TotalSales'];
            $output['DineIneSales'] = $row['DineIneSales'];
            $output['TakeOutSales'] = $row['TakeOutSales'];
            $output['DeliverySales'] = $row['DeliverySales'];
        }
        echo json_encode($output); // converts associative array to JSON string format
    }//end if query
}
?>