<?php
// (1) PHP opens a connection to a MySQL server
// include_once("config/connection.php");  //include the database connection 
// include_once("config/config.php");  //include the application configuration settings
// using include 'connection', is connected to database but AJAX table doesn't load unless using the connection below?
// include("library/helperFunctionsTables.php");

// $table = 'weekly_sales_total';
$conn = mysqli_connect("localhost", "root", "root", "luckycat");  
//=====================
// check connection

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
            echo "<h4>Database Connected</h4>";
        }
    }
}
// end check conneciton
//=====================

//=====================
//***  MySQL query  ***

$sqlViewQuery = "SELECT * FROM weekly_sales_total";

if( mysqli_query($conn,$sqlViewQuery)==TRUE ) { // table query success
        $msg .= "<h2>Sales Data</h2>";
        $result = mysqli_query($conn,$sqlViewQuery); // store View in result variable
        // construct the table headers
        if(__DEBUG == TRUE){
            echo "<br/>";
            echo "<h4>MySQLi result Array:</h4>";
            print_r($result);
        }

        
        // fetch the data and populate
        if( mysqli_num_rows($result) > 0 ) {
            $msg.=  "<h3>Data Found, being stored into JSON</h3>";
            /* go through each column [Field] in associative array $row
                get data and store in a json array   */
            while( $row = mysqli_fetch_array($result) ){
                $dataArray[] = array(
                    'entrydate' => $row['SalesDate'],
                    'total' => $row['TotalSales'],
                    'dinein' => $row['DineInSales'],
                    'takeaway' => $row['TakeAwaySales'],
                    'delivery' => $row['DeliverySales']
                ); 
            } // end while
            // echo "<h4>JSON array : </h4>";
            // echo json_encode($dataArray);
        } else {
            $msg.=  "<h3>Data not Found</h3>";
        }
        //echo $msg;
    } // end VIEW query


//***  END MySQL  ***
//=====================
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
    <h2>Sales Performance 2016</h2>
</header>

<!--============= NAVIGATION section=============-->
<!--========================================-->
<nav>

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
					<li><a href="controller_sales.php">Sales</a></li>
					<li class="active"><a href="controller_performance.php">Performance View</a></li>
					<li><a href="controller_charms.php">Lucky Charms</a></li>
				</ul>	
			</div>
		</div>';
}
// MARKETING
else if( ($_SESSION['loggedin']==TRUE && $_SESSION['user_Role']=='marketer') ) {
	$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
	$contentStringNAV.= 	'<div class="container">';
	$contentStringNAV.= 		'<div class="navbar-header">';
	$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
	$contentStringNAV.= 	'</div>';

	$contentStringNAV.= 	'<ul class="nav navbar-nav">';
	$contentStringNAV.= 		'<li><a href="index.php">Home</a></li>';
	$contentStringNAV.= 		'<li class="active"><a href="controller_performance.php">Performance View</a></li>';
	$contentStringNAV.= 		'<li><a href="controller_charms.php">Lucky Charms</a></li>';
	$contentStringNAV.= 	'</ul>';	
	$contentStringNAV.= 	'</div>';
	$contentStringNAV.= '</div>';
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
	$contentStringNAV.= 		'<li><a href="controller_sales.php">Sales</a></li>'; //sales main page
	$contentStringNAV.= 		'<li class="active"><a href="controller_performance.php">Performance View</a></li>';
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
?>



<!--<?php include("inc/nav.php"); ?>-->

</nav>


<!--============= MAIN section=============-->
<!--========================================-->
<?php
//generateTable($table, $arrayTitles, $arrayData);
?> 
<div id="monitor" class="panel panel-default tab-box">
    <div class="panel-heading">
         <h3 class="panel-title">
            <i class="fa fa-signal"></i>
            Annual Sales Report
        </h3>

        <ul class="nav nav-tabs">
            <li class="active"> <a href="#sales2016-tab" data-toggle="tab" data-identifier="line, donut">Sales 2016</a>
            </li>
            <li> <a href="#sales2017-tab" data-toggle="tab" data-identifier="bar1">Sales 2017</a>
            </li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div id="sales2016-tab" class="tab-pane active">
                <div class="row">
                    <div class="col-sm-12 col-md-12 chart">
                        <div class="caption">Weekly Sales for 2016 <span class="label label-default">€/week</span>

                        </div>
                        <div id="salesChart">
                         <!--LINE CHART GETS FILLED by MORRIS-->
                        </div>
                        <div class="legend"> 
                            <span id="total_sales_legend" class="label">Total</span>
                            <span id="dinein_sales_legend" class="label">DineIn</span>
                            <span id="takeaway_sales_legend" class="label">TakeAway</span>
                            <span id="delivery_sales_legend" class="label">Delivery</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sales2017-tab" class="tab-pane">
                <div class="row">
                    <div class="col-xs-12 chart">
                        <div class="caption">Weekly Sales for 2016 <span class="label label-default">€/week</span>

                        </div>
                        <div id="salesChart2017">
                        <!--CHART GETS FILLED by MORRIS-->
                        </div>
                    </div>
                </div>
            </div>

        </div><!--end Tab Content--> 
    </div>
</div>

<!--<div id="chart"></div>-->

<!--<div id="salesChart"></div>-->


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
		
        // echo "<br/>";
        // print_r($_POST);

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
// $('ul.nav a').on('shown.bs.tab', function (e) {
//     var types = $(this).attr("data-identifier");
//     var typesArray = types.split(",");
//     $.each(typesArray, function (key, value) {
//         eval(value + ".redraw()");
//     })
// });

/*=====================================================*/
// Morris graphs -------------------------------------- //
// (1) Create Chart and load the data.
// define a source object for the Chart 
// bind that source to the php file which returns the JSON data
// define the chart’s categoryAxis(horizontal X axis), valueAxis(vertical Y axis
 /*=====================================================*/
Morris.Line({
    // ID of the element in which to draw the chart.
    element : 'salesChart',

    // Chart data records -- each entry in this array corresponds to a point on chart
    data: <?php echo json_encode($dataArray);?>,

    // The name of the data record attribute that contains x-values.
    xkey:'entrydate',
    xLabels: 'EntryDate',

    // A list of names of data record attributes that contain y-values.
    ykeys:['total', 'dinein', 'takeaway', 'delivery'],
    preUnits: '€ ',

    // Labels for the ykeys -- will be displayed when you hover over the chart
    labels:['TotalSales', 'DineInSales', 'TakeAwaySales', 'DeliverySales'],

    lineColors: ['#454372', '#A52A2A', '#A6B1E1', '#7BB661'],
    // PURPLE, RED, INDIGO, GREEN
    // Disables line smoothing
    smooth: true,
    resize: true,

    hideHover:'auto'
});

var form_data = $("#formSales").serialize();





// TESTING 1
// Morris.Line({
//   // ID of the element in which to draw the chart.
//   element: 'chart',
//   // Chart data records -- each entry in this array corresponds to a point on
//   // the chart.
//   data: [
//     { year: '2008', value: 20 },
//     { year: '2009', value: 10 },
//     { year: '2010', value: 5 },
//     { year: '2011', value: 5 },
//     { year: '2012', value: 20 }
//   ],
//   // The name of the data record attribute that contains x-values.
//   xkey: 'year',
//   // A list of names of data record attributes that contain y-values.
//   ykeys: ['value'],
//   // Labels for the ykeys -- will be displayed when you hover over the
//   // chart.
//   labels: ['Value'],
//   hideHover:'auto'
// });


// TESTING2 2
// Morris.Bar({
//   element: 'chart',
//   data: [
//     { y: '2006', a: 100, b: 90 },
//     { y: '2007', a: 75,  b: 65 },
//     { y: '2008', a: 50,  b: 40 },
//     { y: '2009', a: 75,  b: 65 },
//     { y: '2010', a: 50,  b: 40 },
//     { y: '2011', a: 75,  b: 65 },
//     { y: '2012', a: 100, b: 90 }
//   ],
//   xkey: 'y',
//   ykeys: ['a', 'b'],
//   labels: ['Series A', 'Series B']
// });


// TESTING 3
// Morris.Area({
//   element: 'chart',
//   data: [
//     { y: '2006', a: 100, b: 90 },
//     { y: '2007', a: 75,  b: 65 },
//     { y: '2008', a: 50,  b: 40 },
//     { y: '2009', a: 75,  b: 65 },
//     { y: '2010', a: 50,  b: 40 },
//     { y: '2011', a: 75,  b: 65 },
//     { y: '2012', a: 100, b: 90 }
//   ],
//   xkey: 'y',
//   ykeys: ['a', 'b'],
//   labels: ['Series A', 'Series B']
// });


// TEST DONUT

// Morris.Donut({
//   element: 'chart',
//   data: [
//     {label: "Credit", value: 12},
//     {label: "Debit", value: 30},
//     {label: "Loan", value: 20}
//   ]
// });

// Morris graphs -------------------------------------------------------- //
</script>


</body>
</html>