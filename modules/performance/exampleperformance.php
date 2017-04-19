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
</header>

<!--============= NAVIGATION section=============-->
<!--========================================-->
<nav>
<?php include("inc/nav.php"); ?>
<!--<?php echo $contentStringNAV; ?> -->

</nav>


<!--============= MAIN section=============-->
<!--========================================-->
<div id="monitor" class="panel panel-default tab-box">
    <div class="panel-heading">
         <h3 class="panel-title">
            <i class="fa fa-signal"></i>
            Monitoring report
        </h3>

        <ul class="nav nav-tabs">
            <li class="active"> <a href="#fuel-tab" data-toggle="tab" data-identifier="line, donut">Fuel data</a>

            </li>
            <li> <a href="#co2-tab" data-toggle="tab" data-identifier="bar1">Co2 data</a>

            </li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div id="fuel-tab" class="tab-pane active">
                <div class="row">
                    <div class="col-sm-12 col-md-7 chart">
                        <div class="caption">Fuel consumption last 12 months <span class="label label-default">Liter/100km</span>

                        </div>
                        <div id="fuel-consumption"></div>
                        <div class="legend"> <span id="city" class="label">City</span>
 <span id="highway" class="label">Highway</span>
 <span id="idle" class="label">Idle</span>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5 chart">
                        <div class="caption">Fuel projection this month</div>
                        <div id="fuel-projection"></div>
                        <div class="legend"> <span id="projection" class="label">Projection</span>
 <span id="today" class="label">Until today</span>

                        </div>
                    </div>
                </div>
            </div>
            <div id="co2-tab" class="tab-pane">
                <div class="row">
                    <div class="col-xs-12 chart">
                        <div class="caption">Monthly Co2 Emissions <span class="label label-default">g/km</span>

                        </div>
                        <div id="co2-emissions"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
$('ul.nav a').on('shown.bs.tab', function (e) {
    var types = $(this).attr("data-identifier");
    var typesArray = types.split(",");
    $.each(typesArray, function (key, value) {
        eval(value + ".redraw()");
    })
});
/*=====================================================*/
// Morris graphs ---------------------------------------------------------- //
/*=====================================================*/
// on doc ready
$(function () {
    // Fuel consumption //
    // Data set for fuel consumption
    var fuel_data = [{
        "period": "2013-01",
        "city": 66,
        "highway": 34,
        "idle": 9
    }, {
        "period": "2013-02",
        "city": 62,
        "highway": 33,
        "idle": 8
    }, {
        "period": "2013-03",
        "city": 61,
        "highway": 32,
        "idle": 7
    }, {
        "period": "2013-04",
        "city": 66,
        "highway": 32,
        "idle": 6
    }, {
        "period": "2013-05",
        "city": 67,
        "highway": 31,
        "idle": 5
    }, {
        "period": "2013-06",
        "city": 68,
        "highway": 43,
        "idle": 7
    }, {
        "period": "2013-07",
        "city": 62,
        "highway": 32,
        "idle": 5
    }, {
        "period": "2013-08",
        "city": 61,
        "highway": 32,
        "idle": 5
    }, {
        "period": "2013-09",
        "city": 58,
        "highway": 32,
        "idle": 7
    }, {
        "period": "2013-10",
        "city": 60,
        "highway": 32,
        "idle": 7
    }, {
        "period": "2013-11",
        "city": 60,
        "highway": 32,
        "idle": 6
    }, {
        "period": "2013-12",
        "city": 62,
        "highway": 32,
        "idle": 8
    }];
    // Line chart parameters for fuel consumption
    var fuel_consumption = {
        element: 'fuel-consumption',
        hideHover: 'auto',
        data: fuel_data,
        xkey: 'period',
        xLabels: 'month',
        ykeys: ['city', 'highway', 'idle'],
        postUnits: ' l/100km',
        labels: ['City', 'Highway', 'Idle'],
        resize: true,
        lineColors: ['#A52A2A', '#72A0C1', '#7BB661']
        //yLabelFormat: function(y) { return y.toString() + ' l/100km'; }
    }

    // Make a line chart from the parameters
    line = Morris.Line(fuel_consumption)
    // / Fuel consumption //

    // Fuel projection //
    // Data set for fuel projection
    var projection_data = [{
        label: 'Until today',
        value: 180
    }, {
        label: 'Projected',
        value: 400
    }, ]
    // Donut chart parameters for fuel projection
    var fuel_projection = {
        element: 'fuel-projection',
        hideHover: 'auto',
        resize: true,
        data: projection_data,
        colors: ['#7BB661', '#72A0C1'],
        formatter: function (y) {
            return y + " liters"
        }
    }

    // Make a donut chart from the parameters
    donut = Morris.Donut(fuel_projection)
    // / Fuel projection //

    // Fuel emissions //
    // Data set for fuel emissions
    var co2_data = [{
        month: 'Jan',
        emissions: 35
    }, {
        month: 'Feb',
        emissions: 37
    }, {
        month: 'Mar',
        emissions: 40
    }, {
        month: 'Apr',
        emissions: 38
    }, {
        month: 'Maj',
        emissions: 39
    }, {
        month: 'Jun',
        emissions: 42
    }, {
        month: 'Jul',
        emissions: 37
    }, {
        month: 'Aug',
        emissions: 65
    }, {
        month: 'Sep',
        emissions: 38
    }, {
        month: 'Okt',
        emissions: 45
    }, {
        month: 'Nov',
        emissions: 41
    }, {
        month: 'Dec',
        emissions: 41
    }]
    //Bar chart parameters for CO2 emissions
    var co2_emissions = {
        element: 'co2-emissions',
        resize: true,
        data: co2_data,
        xkey: 'month',
        ykeys: ['emissions'],
        labels: ['Co2 emissions'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        postUnits: ' g/km',
        formatter: function (y) {
            return y + " g/km"
        }
    }

    // Make a bar chart from the parameters
    bar1 = Morris.Bar(co2_emissions)
    // / Fuel emisisons //
});
// / Morris graphs -------------------------------------------------------- //
</script>


</body>
</html>

