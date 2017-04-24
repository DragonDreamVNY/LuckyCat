<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// (1) PHP opens a connection to a MySQL server
// include_once("config/connection.php");  //include the database connection 
// include_once("config/config.php");  //include the application configuration settings
// ??? PROBLEM ??? using include 'connection', is connected to database but AJAX table
// doesn't load unless using the hardcoded connection below?

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
            echo "<h3>Database Connected</h3>";
        }
    }
}
// end check conneciton
//=====================

//echo "<h3>action button function loaded</h3>";
// =====================
// 		ACTION button
// =====================
$output = '';
if( isset($_POST["action"]) ){ // 'action' on insertSales/crudSales form
    
    //(2) The data is found
    // "VIEW weekly sales" with Total. 
    $sqlViewQuery = "SELECT * FROM weekly_sales_total";
    // $sqlViewQuery = "CALL view_weekly_sales()"; 
    // $sqlViewQuery = "CALL view_weekly_procedure()"; 


    //=====================
    // execute the VIEW 

    if( mysqli_query($conn,$sqlViewQuery)==TRUE ) { // table query success
        $msg .= "<h2>Sales Data</h2>";
        $result = mysqli_query($conn,$sqlViewQuery); // store View in result variable
        // construct the table headers
        if(__DEBUG == TRUE){
            echo "<br/>";
            echo "<h4>MySQLi result Array:</h4>";
            print_r($result);
        }

        //(3) HTML Table is created filled with data sent to "resultsTable" placeholder
        $output .= '
            <table class="table-bordered salesTable">
                <tr>
                    <th class="tableHeader" width="10%">TransactionID</th>
                    <th class="tableHeader" width="15%">Date</th>
                    <th class="tableHeader" width="25%">Total €</th>
                    <th class="tableHeader" width="17%">Dine In Sales €</th>
                    <th class="tableHeader" width="17%">Take Out Sales €</th>
                    <th class="tableHeader" width="16%">Delivery Sales € </th>
                </tr>
        ';
        // fetch the data and populate
        if( mysqli_num_rows($result) > 0 ) {
            // go through each column [Field] in associative array $row
            while( $row = mysqli_fetch_array($result) ){

                $output .= ' 
                    <tr id="salesRow_'.$row["TransactionID"].'">
                        <td align="center" class="tableContent">'.$row["TransactionID"].'</td>
                        <td align="center" class="tableContent">'.$row["SalesDate"].'</td>
                        <td align="center" class="tableContent">'.$row["TotalSales"].'</td>
                        <td align="center" class="tableContent">'.$row["DineInSales"].'</td>
                        <td align="center" class="tableContent">'.$row["TakeAwaySales"].'</td>
                        <td align="center" class="tableContent">'.$row["DeliverySales"].'</td>
                        <td>
                            <button type="button" name="updateSales_button" id="update-'.$row["TransactionID"].'" class="updateSales_button btn-default">UPDATE</button>
                        </td>
                        <td>
                            <button type="button" name="delSales_button" class="delSales_button btn-danger" id="del-'.$row["TransactionID"].'">DELETE</button>
                        </td>
                    </tr>
                ';       
            }
        } else {
            $msg.=  "<h3>Data not Found</h3>";
            $output .= '
                <tr>
                    <td colspan = "4">Data not Found</td>
                </tr>
            ';
        }
        $output .= '</table>';
        echo $output;
    } // end VIEW query
    //echo "<h3>end action button function executed</h3>";
} //end isset 'action'

?>