<?php

$table='users';  //table to insert values into
	
$msg='';  //this is an empty message initially , it will contain the result of the insertion
	
//INSERT QUERY
//get the values entered in the form
// $userRole = $conn->real_escape_string($_POST['user_Role']);
// $username = $conn->real_escape_string($_POST['user_LogInName']);
// $userFirstName = $conn->real_escape_string($_POST['user_FirstName']);
// $userLastName = $conn->real_escape_string($_POST['user_LastName']);
// $userEmail = $conn->real_escape_string($_POST['user_Email']);
// $pass1 = $_POST['user_Pass1'];
// $pass2 = $_POST['user_Pass2'];		

if (isset($_POST['user_Role'])) { 		$userRole = 	mysqli_real_escape_string($conn, $_POST['user_Role']); } else{ $userRole = ''; }
if (isset($_POST['user_LogInName'])) { 	$username = 	mysqli_real_escape_string($conn, $_POST['user_LogInName']); } 	 else{ $username = ''; }
if (isset($_POST['user_FirstName'])) { 	$userFirstName =mysqli_real_escape_string($conn, $_POST['user_FirstName']); }  else{ $userFirstName = ''; }
if (isset($_POST['user_LastName'])) { 	$userLastName = mysqli_real_escape_string($conn, $_POST['user_LastName']); } else{ $userLastName = ''; }
if (isset($_POST['user_Email'])) { 		$userEmail = 	mysqli_real_escape_string($conn, $_POST['user_Email']); }else{ $userEmail = ''; }
if (isset($_POST['user_Pass1'])) { 		$pass1 = 		mysqli_real_escape_string($conn, $_POST['user_Pass1']); } else{ $pass1 = ''; }
if (isset($_POST['user_Pass2'])) { 		$pass2 = 		mysqli_real_escape_string($conn, $_POST['user_Pass2']); }else{ $pass2 = ''; }

//salts for the password before encryption
$salt1 = "!lng";
$salt2 = "&fng";
	
if ($pass1===$pass2){
		//HASHING the PASSWORD
		$passwordEncrypted = sha1("$salt1$pass1$salt2");  //sha1 algorithm requires 40 chars field length. Salts are added to the String
		
		//construct the SQL
		// $sqlInsert= "INSERT INTO $table (user_Role, user_LogInName, user_Password, user_FirstName, user_LastName, user_Email) VALUES('$userRole','$username','$passwordEncrypted','$userFirstName','$userLastName', '$userEmail')";
		// $sqlInsert = "call luckycat.register_user('mayor', 'green@rrow', 'smoakinHot1', 'Oliver', 'Queen', 'olly@mayor.starcity.com');";		
		// $sqlInsert = "CALL register_user('".$userRole."', '".$username."', '".$passwordEncrypted."', '".$userFirstName."', '".$userLastName."', '".$userEmail."')";
		$sqlInsert = "CALL register_user('$userRole', '$username', '$passwordEncrypted', '$userFirstName', '$userLastName', '$userEmail')";
		if(query($conn,$sqlInsert)==1) { 
		$msg.= "<h3>SUCCESS: New User data Registered</h3>";
		
		}
		else{
		$msg.=  "<h3>FAIL: User data not registered</h3>";
		}
		
	}
	else { 
		$msg.= "<h3> A problem occured - data not entered</h3>";
	}
				
			
//prepare the result of the insertion for display in a view

//Query string
$sqlData="SELECT * FROM $table WHERE user_LogInName='$username'";  //get the data from the table
$sqlTitles="SHOW COLUMNS FROM $table";  //get the table column descriptions

//execute the 2 queries
// $rsData=getTableData($conn,$sqlData);
// $rsTitles=getTableData($conn,$sqlTitles);

// //check the results 
// $arrayData=checkResultSet($rsData);
// $arrayTitles=checkResultSet($rsTitles);


// $result = mysqli_query($conn,$sqlData);
// $output .= '
//             <table class="<table table-bordered salesTable">
//                 <tr>
//                     <th class="tableHeader" width="10%">First Name</th>
//                     <th class="tableHeader" width="15%">Last Name</th>
//                     <th class="tableHeader" width="25%">username</th>
//                     <th class="tableHeader" width="17%">Role</th>
//                     <th class="tableHeader" width="17%">email</th>
//                     <th class="tableHeader" width="16%">Password</th>
//                 </tr>
//         ';
//         // fetch the data and populate
//         if( mysqli_num_rows($result) > 0 ) {
//             // go through each column [Field] in associative array $row
//             while( $row = mysql_fetch_field($result) ){
//                 $output .= ' 
//                     <tr>
//                         <td align="center" class="tableContent">'.$row["user_FirstName"].'</td>
//                         <td align="center" class="tableContent">'.$row["user_LastName"].'</td>
//                         <td align="center" class="tableContent">'.$row["user_LogInName"].'</td>
//                         <td align="center" class="tableContent">'.$row["user_Role"].'</td>
//                         <td align="center" class="tableContent">'.$row["user_Email"].'</td>
//                         <td align="center" class="tableContent">********</td>
//                     </tr>
//                 ';       
//             }
//         } else {
//             $msg.=  "<h3>Data not Found</h3>";
//             $output .= '
//                 <tr>
//                     <td colspan = "4">Data not Found</td>
//                 </tr>
//             ';
//         }
//         $output .= '</table>';
//         echo $output;

$conn->close();


//-----------------------------------------------------
//prepare view template values
$tab='Lucky Cat';
$pageHeading='User Registration';


// =====================
// 		NAVIGATION
// =====================
//nav section content - not logged in
$contentStringNAV='';
$contentStringNAV.= '<div class="navbar navbar-default" role="navigation">';
$contentStringNAV.= 	'<div class="container">';
$contentStringNAV.= 		'<div class="navbar-header">';
$contentStringNAV.= 		'<a class="navbar-brand" href="index.php"><img src="images/luckyLogo.png" alt = "lucky cat logo"></a>';
$contentStringNAV.= 	'</div>';
$contentStringNAV.= 	'<ul class="nav navbar-nav">';
$contentStringNAV.= 		'<li><a href="index.php">Home</a></li>';
$contentStringNAV.= 	'</ul>';	
$contentStringNAV.= 	'</div>';
$contentStringNAV.= '</div>';

// =====================
// 		MAIN
// =====================
// $contentStringMAIN= $msg;
$contentStringMAIN.='<div class ="container">';
$contentStringMAIN.=	'<a href="controller_main.php"><button class="btn btn-default" role="button">';
$contentStringMAIN.=		'Click Here to return to Log In';
$contentStringMAIN.=	'</button></a>';
$contentStringMAIN.='</div>';

// =====================
// 		FOOTER
// =====================
$contentStringFOOTER='';


if (__DEBUG==TRUE) //construct the footer with debug information 
{	
	$contentStringFOOTER.= '<footer class="debug">';

	$contentStringFOOTER.=  '<h3>***DEBUG INFORMATION***</h3>';
	
	$contentStringFOOTER.=  '<h4>SQL</h4>';
	$contentStringFOOTER.=  $sql;

	
	$contentStringFOOTER.=  '<h4>$_POST Array</h4>';
	foreach($_POST as $key=>$value){
		$contentStringFOOTER.=  '$_POST[\''.$key."'] = ".$value.'</br>';
	}
	if(isset($sqlInsert)){
		$contentStringFOOTER.=  '<h4>SQL QUERY</h4>';
		$contentStringFOOTER.= $sql;
	}
	
	$contentStringFOOTER.=  "</footer>";
}
else{ //construct the standard footer
	$contentStringFOOTER.='<footer class="copyright">';
	$contentStringFOOTER.= 'Copyright 2017 Vincent Lee';
	$contentStringFOOTER.= "</footer>";
}


?>


















 



