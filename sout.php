<?php
	session_start();
	if( isset($_SESSION['UIDN']) ){
		
	}
	else{
		echo "ONLY LOGGED IN USERS CAN ACCESS THIS PAGE";
		return;
	}

	//database connection
	$dbhost = "localhost";
	$dbuser = "sharif";
	$dbpass = "sharifahmad123";
	$dbname = "web_proj";

	$connection = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);


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