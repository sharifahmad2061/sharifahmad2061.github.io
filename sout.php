<?php
	session_start();
	if( isset($_SESSION['UIDN']) ){
		
	}
	else{
		echo "ONLY LOGGED IN USERS CAN ACCESS THIS PAGE";
		return;
	}

	include_once('./db_connection.php');


	$query = "UPDATE user_status SET status='offline' WHERE u_id={$_SESSION["UIDN"]};";
	$result = mysqli_query($connection, $query);
	if ($result) {
		session_destroy();
		echo "user logged out";
	}
	else{
		echo "you haven't been logged out";
	}

?>