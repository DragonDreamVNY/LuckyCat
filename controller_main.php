<?php
//includes
include_once("config/config.php");  //include the application configuration settings

//Start/join a session
session_start();  //this must come BEFORE the <HTML> tag

//initialise session variable used by controller
if(!isset($_SESSION['loggedin'])){$_SESSION['loggedin']=FALSE;}
if(!isset($_SESSION['loginAttempts'])){$_SESSION['loginAttempts']=0;}
if(!isset($_SESSION['views'])){$_SESSION['views']=0;}

include("modules/home/model_home.php"); 
include("modules/home//view_home.php");


?>