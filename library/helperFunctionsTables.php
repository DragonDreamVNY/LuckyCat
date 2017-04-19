<?php
//helper functions

// resultset Table Titles or Data
function getTableData($connection,$sql) {
	try {
		$rs=$connection->query($sql);
		return $rs;
	}
	//catch exception
	catch(Exception $e) {
		if (__DEBUG==TRUE) {
			//DEBUG mode is enabled
			echo '<hr><h2>helperFunctionsTables.php  - getTableDataDebug Information:</h2>';
			echo '<h4>Error message $e:</h4>';
			echo 'Message: ' .$e->getMessage();
			//echo '<h4>Post Array:</h4>';
			//print_r($_POST);
			//echo '<h4>SQL:</h4>';
			//echo '$sql string:'.$sql'<br>';
			exit('<p class="warning">PHP script terminated');		
		}
		else {
			//DEBUG mode is disabled
			header("Location:".__USER_ERROR_PAGE);
		}
	}
}

function checkResultSet($rs) {
	if($rs === FALSE) {
		if (__DEBUG==TRUE) {
			//DEBUG mode is enabled
			echo '<hr><h2>helperFunctionsTables.php  - getTableDataDbug Information:</h2>';
			echo '<h4>Error message: ResultSet is Empty - check table name</h4>';
			exit('<p class="warning">PHP script terminated');		
		}
		else {	
			header("Location:".__USER_ERROR_PAGE);
		}
	} else {
		
		while ($row = $rs->fetch_assoc()) {
			$arr[] = $row; //put the result into an array
		}               
                
		return $arr;
	}
}

function generateTable($tableName, $titlesResultSet, $dataResultSet) {
	/*
	This helper function is used to dynamically generate HTML tables.
	It is typically called from a VIEW. 
	
	The function call takes the following arguments:
		$tableName :
					STRING containing the name of the table. This
					will appear in the caption at the top of the table.
		$titlesResultSet : 
					ASSOCIATIVE ARRAY : containing the column 
					headings of the table. 
		$dataResultSet: 
					ASSOCIATIVE ARRAY : containing the data to be presented in
					the table. 
	*/
	
	echo "<table border=1>";

	//first - create the table caption and headings
	echo "<caption>".strtoupper($tableName)." TABLE - QUERY RESULT</caption>";
	echo '<tr>';
	foreach($titlesResultSet as $fieldName) {
		echo '<th>'.$fieldName['Field'].'</th>';
	}
	echo '</tr>';

	//then show the data
	foreach($dataResultSet as $row) {
		echo '<tr>';
		foreach($titlesResultSet as $fieldName) {
			echo '<td>'.$row[$fieldName['Field']].'</td>';}
		echo '</tr>';
		}
	echo "</table>";
}


function generateEditDeleteTable($tableName, $pk, $titlesResultSet, $dataResultSet)
{
	/*
	This helper function is used to dynamically generate HTML tables 
	with EDIT and DELETE buttons.
	
	It is typically called from a VIEW. 
	
	The function call takes the following arguments:
		$tableName :
					STRING containing the name of the table. This
					will appear in the caption at the top of the table.
		$pk	:
					STRING containing the primary key (column name) of the
					table. It is used to generate the 'hidden' input
					value of the form. 
		$titlesResultSet : 
					ASSOCIATIVE ARRAY : containing the column 
					headings of the table. 
		$dataResultSet: 
					ASSOCIATIVE ARRAY : containing the data to be presented in
					the table. 
	*/

	echo "<table border=1>";

	//first - create the table caption and headings
	echo "<caption>".strtoupper($tableName)." - EDIT/DELETE TABLE</caption>";
	echo '<tr>';
	foreach($titlesResultSet as $fieldName) {
		echo '<th>'.$fieldName['Field'].'</th>';
	}
	echo '<th>EDIT</th><th>DELETE</th>';
	echo '</tr>';

	//then generate the table of data with buttons for edit and delete
	foreach($dataResultSet as $row) {
		echo '<tr>';
		echo '<td>'.$row['user_ID'].'</td>';
		echo '<td>'.$row['user_Role'].'</td>';
		echo '<td>'.$row['user_FirstName'].'</td>';
		echo '<td>'.$row['user_LastName'].'</td>';
		echo '<td>'.$row['user_Email'].'</td>';
		
		echo '<form class="small_button"  action="controller_Ex03_delete_and_edit.php" method="post">';
		echo '<td><input class="smallBtn"  type="submit"  value="Delete" name="btn_select_for_deletion"></td>';
		echo '<td><input class="smallBtn"  type="submit"  value="Edit" name="btn_edit"></td>';
		echo '<input type="hidden" value="'.$row[$pk].'" name="user_ID">';//when the button is pressed the 
																				//$index 'hidden' value is inserted 
																				//into the $_POST array
																				// either DELETE or EDIT, Primary Key is the one for THIS ROW
		echo '</form>';

		echo '</tr>';
		}
	echo "</table>";
}

?>
