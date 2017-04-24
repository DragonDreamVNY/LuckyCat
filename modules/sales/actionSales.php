<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// include_once("config/connection.php");  //include the database connection 
// include_once("config/config.php");  //include the application configuration settings
$table='sales'; 
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

$errors = array();      // array to hold validation errors
$data  = array();      // array to pass back data
// validate the variables ======================================================
    // if any of these variables don't exist, add an error to our $errors array

    if (empty($_POST['sale_date'])){
        $errors['sale_date'] = 'sale_date is required.';
    }
    if (empty($_POST['dineIn_sales'])){
        $errors['dineIn_sales'] = 'dineIn_sales is required.';
    }
    if (empty($_POST['takeAway_sales'])){
        $errors['takeAway_sales'] = 'takeAway_sales is required.';
    }
    if (empty($_POST['delivery_sales'])){
        $errors['delivery_sales'] = 'delivery_sales is required.';
    }

    // return a response ===========================================================

    // if there are any errors in our errors array, return a success boolean of false
    if ( ! empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
        // if there are no errors process our form, then return a message

        // DO ALL FORM PROCESSING HERE (UPDATE, INSERT, DELETE)

        // show a message of success and provide a true success variable
        $data['success'] = true;
        $data['message'] = 'Success!';
    }

    // return all our data to an AJAX call
    echo json_encode($data);

// =====================
// 		ACTION button
// =====================
$output = '';

if( isset($_POST["action"]) ){ // 'action' button is pressed on insertSales form
    
    // =====================
    // 		INSERT action button
    // =====================
    if($_POST["action"] == "INSERT")
    {
        //INSERT QUERY : get the values entered in the form
        // $salesTransactionIDAUTO = ''; // or NULL, for auto increment TransactionID

        if (isset($_POST['transactionID'])) { $transactionID = 	mysqli_real_escape_string($conn, $_POST['transactionID']); } else{ $transactionID = ''; }
        if (isset($_POST['sale_date'])) { $saleDate = 			mysqli_real_escape_string($conn, $_POST['sale_date']); } 	 else{ $saleDate = ''; }
        if (isset($_POST['dineIn_sales'])) { $dineSales = 		mysqli_real_escape_string($conn, $_POST['dineIn_sales']); }  else{ $dineSales = ''; }
        if (isset($_POST['takeOut_sales'])) { $takeSales = 		mysqli_real_escape_string($conn, $_POST['takeOut_sales']); } else{ $takeSales = ''; }
        if (isset($_POST['delivery_sales'])) { $deliverSales = 	mysqli_real_escape_string($conn, $_POST['delivery_sales']); }else{ $deliverSales = ''; }
        // Input form enters into columns: [SaleDate][TotalSales][DineInSales][TakeOutSales][DeliverySales]

        // reformat the date for MySQL
        // $dateUnformatted = strtotime($saleDate);
        $dateParts = explode('-', $saleDate); // to reformat from 'DD-MM-YYYY'
        $mysqlDate = "$dateParts[2]-$dateParts[1]-$dateParts[0]"; // to 'YYYY-MM-DD'
        
        /*=================================
        / call insert Sales Stored Procedure
        =================================*/
        // a) 'INSERT Sales' query
        // $sqlInsert = "INSERT INTO weekly_sales_itemised VALUES( '','".$mysqlDate."','".$dineSales."','".$takeSales."','".$deliverSales."')";
        
        // b) call 'INSERT Sales' Stored Procedure ([ID = 0(auto incremented)] [SaleDate] [DineInSales] [TakeOutSales] [DeliverySales])
        $sqlInsertRow = "CALL insert_weekly_sales('".$mysqlDate."', '".$dineSales."', '".$takeSales."', '".$deliverSales."')";

        // JSON object with form data in associative array
        // $formdata = array(
        //     'saleDate' => $saleDate,
        //     'dineSales' => $dineSales,
        //     'takeSales' => $takeSales,
        //     'deliverSales' => $deliverSales
        // );

        //=====================
        //execute the INSERT query
        //=====================
        $insert_isRun = mysqli_query($conn,$sqlInsertRow);

        if( $insert_isRun ) { //insert Sales
            $msg = "<h3>New data inserted successfully</h3>";
            echo 'Data inserted';

        } else {
            $msg.=  "<h3>New data has not been inserted </h3>";
        }
        echo $msg;
    
       
        echo "<h3>end action button function executed</h3>";
    } // end POST action INSERT

    elseif(isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"])) 	// do we have a delete request? $_POST["recordToDelete"]
    {
        //sanitize post value, PHP filter FILTER_SANITIZE_NUMBER_INT removes all characters except digits, plus and minus sign.
        $idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 
        
        //try deleting record using the record ID we received from POST
        $sqlDelete = "DELETE FROM $table WHERE sales_TransactionID=$idToDelete";
        $delete_row = $mysqli($conn, $sqlDelete);
        
        if(!$delete_row) {    
            //If mysql delete query was unsuccessful, output error 
            header('HTTP/1.1 500 Could not delete record!');
            exit();
        } else{
            $msg = "<h3>Record Deleted successfully</h3>";
            echo $msg;
        }
        $mysqli->close(); //close db connection
    }
    else{
        //Output error
        header('HTTP/1.1 500 Error occurred, Could not process request!');
        exit();
    }
    /* ************** END DELETE   ************** 
    // ----------------------------------------*/

    // =====================
    // 		UPDATE action button
    // =====================
    if($_POST["action"] == "Fetch Single Row")
    {
        $output = '';
        $query = "SELECT * FROM weekly_sales_total WHERE TransactionID = '".$_POST["TransactionID"]."'";
        $result = execute_query($conn, $query);
        while($row = mysqli_fetch_array($result)){
            $output["sales_date"] = $row['sale_date'];
            $output["dineIn_sales"] = $row['dineIn_sales'];
            $output["takeOut_sales"] = $row['takeOut_sales'];
            $output["delivery_sales"] = $row['delivery_sales'];
        }
        echo json_encode($output);
    } //end FETCH SINGLE ROW

    if($_POST["action"] == "UPDATE")
    {
        $transactionID = 	mysqli_real_escape_string($conn, $_POST['TransactionID']); 
        $saleDate = 		mysqli_real_escape_string($conn, $_POST['sale_date']); 
        $dineInSales = 		mysqli_real_escape_string($conn, $_POST['dineIn_sales']); 
        $takeAwaySales = 		mysqli_real_escape_string($conn, $_POST['takeOut_sales']); 
        $deliverySales = 	mysqli_real_escape_string($conn, $_POST['delivery_sales']); 
        
        $updateQuery = "CALL update_weekly_sales('$transactionID', '$saleDate', '$dineInSales', '$takeAwaySales', '$deliverySales')";;
        execute_query($conn, $updateQuery);
        echo "Data Updated";
    }

} // end isset 'action'


?>