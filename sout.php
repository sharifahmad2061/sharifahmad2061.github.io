<?php
	session_start();
	// print_r($_SESSION);

	// echo "hello";
	
	if(isset($_SESSION['UIDN'])){
		include_once('./db_connection.php');
		// echo "I've reached here";
		$query = "UPDATE user_status SET status='offline' WHERE u_id={$_SESSION['UIDN']};";
		$result = mysqli_query($connection, $query);
		if ($result) {
			$_SESSION = array();
			header("Location: http://localhost:8090/sharifahmad2061.github.io/index.php");
		}
		else{
			echo "you haven't been logged out";
		}
	}	//end of if
	else{
		echo "ONLY LOGGED IN USERS CAN ACCESS THIS PAGE";
		return;
	}

	mysqli_close($connection);
	session_destroy();	
?>
