<?php
	session_start();
	// print_r($_SESSION);

	include_once('./db_connection.php');
	// echo "hello";
	
	if(isset($_SESSION['UIDN'])){
		// echo "I've reached here";
		$query = "UPDATE user_status SET status='offline' WHERE u_id={$_SESSION['UIDN']};";
		$result = mysqli_query($connection, $query);
		if ($result) {
			$_SESSION = array();
			// echo "user logged out";
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





<!-- 	session_start();
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		echo $_COOKIE['TestCookie'];
	}
	print_r($_SESSION);
	include_once('./db_connection.php');
	if(isset($_SESSION['UIDN'])){
		echo "I've reached here";
		setcookie("TestCookie", "hello", time()+3600);
		$query = "UPDATE user_status SET status='hello' WHERE u_id={$_SESSION['UIDN']};";
		$result = mysqli_query($connection, $query);
		if ($result) {
			session_destroy();
			echo "user logged out";
		}
		else{
			echo "you haven't been logged out";
		}
	}	//end of if
	else{
		echo "ONLY LOGGED IN USERS CAN ACCESS THIS PAGE";
		return;
	} -->