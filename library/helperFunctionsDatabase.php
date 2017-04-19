<?php
//helper functions for database interaction

function query($connection,$sql){
	try {
		 //execute the insert sql
		if ($connection->query($sql)===TRUE){
			return 1;  //if successful
		}
		else{
			return 0;  //if not successful
		}
	}
	//catch exception
	catch(Exception $e) {
		if (__DEBUG==TRUE){ 
			echo 'Message: ' .$e->getMessage();
			print_r($sql);
			exit('<p class="warning">PHP script terminated');
		}
		else{	
			header("Location:".__USER_ERROR_PAGE);
		}
	}
}

?>
