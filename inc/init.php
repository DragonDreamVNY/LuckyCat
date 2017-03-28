<?php
	set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

	require("_/inc/functions.php");

	//Constants
	define("FROM_EMAIL", "luckycat.dragondreamdesign.com <webform@luckycat.dragondreamdesign.com>");
	
	//Setup Variable for tracking VirtualPageViews in analytics.
	$VirtualPageView = "";

	//Variables to store Site/URL information
	$ServerName = $_SERVER['SERVER_NAME'];
	$SiteSection = "";
	$SubSection = "";

	$RequestMethod = $_SERVER['REQUEST_METHOD'];
	$FormErrors = array();

	setSectionInfo();

	//SET SERVER SPECIFIC VARIABLES AND CONSTANTS
	switch ($ServerName) {
		case '':
			define("CONTACT_EMAIL", "");
			define("ANALYTICS_ID", "");
			break;
		
		case 'luckycat.dragondreamdesign.com':
			define("CONTACT_EMAIL", "");
			define("ANALYTICS_ID", "");
			break;
	}

?>