<!doctype html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9 lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
  <head>

    <meta charset="utf-8">

    <!--<base href="/luckycat/"> -->
    <!--breaks relative links on localhost-->

    <title>Lucky Cat Business</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <!--stylesheet linkss-->
    <?php require("inc/head.php"); ?>
    

  </head>
  <body>
    <!--[if lte IE 8]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!--  site or application content here -->
    <div class="header">
      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <a class="navbar-brand" href="/index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>
          </div>

            <ul class="nav navbar-nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="modules/sales/sales.php">Sales</a></li>
              <li><a href="modules/performance//kpi.php">Performance View</a></li>
              <li><a href="modules/luckycahrms/luckycharms.php">Lucky Charms</a></li>
              <li><a href="/">Contact</a></li>
            </ul>

        </div>
      </div>
    </div><!--end header-->

    <div class="jumbotron">
      <h1>'Welcome!</h1>
      <p class="lead">
        <img src="images/luckycatDash.png" alt="I'm alt image info"><br>
        Lucky Cat Business Dashboard
      </p>

      <div class="btn-group" data-toggle="buttons">

        <a href="sales/sales.php"><button class="btn btn-success" btn-checkbox>
          Sales Data
        </button></a>

        <a href="performance/kpi.html"><button class="btn btn-primary"  btn-checkbox>
          Performance View
        </button></a>

        <a href="/luckycharms/luckycharms.html"><button class="btn btn-danger"  btn-checkbox>
          Lucky Charms
        </button></a>

    </div>


    </div> <!--end jumbotron-->


    <!--[if lt IE 9]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. 
        Please <a href="http://browsehappy.com/">upgrade your browser</a> 
        or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <?php require('inc/footer.php'); ?>

    <!-- JAVASCRIPT -->
    <?php require('inc/tail.php'); ?>

</body>
</html>
