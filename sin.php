<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
	}
	else{
		echo "the page does not work for \"GET\" requests.";
		return;
	}


	//response variable
	$returnJson = array();

	//obtain sign in info
	$reg = $_POST['uidn'];
	$pass = $_POST['psd'];

	//database connection
	$dbhost = "localhost";
	$dbuser = "sharif";
	$dbpass = "sharifahmad123";
	$dbname = "web_proj";

	// var_dump($reg, $pass);
	$connection = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);

	if(mysqli_connect_errno()){
		die("db connection failed: ".mysqli_connect_error(). " (" . mysqli_connect_errno(). " )");
	}

	$query = "SELECT * FROM sign_in WHERE uidn={$reg} AND password='{$pass}';";
	$result = mysqli_query($connection, $query);

	$row = mysqli_fetch_assoc($result);
	if (empty($row)) {	//if no user login data is incorrect
		$returnJson['success'] = 'false';
	}else{		//if user login data is correct
		$query = "UPDATE user_status SET status='online' WHERE u_id={$reg};";
		mysqli_query($connection, $query);
		$returnJson['success'] = 'true';
	}

	$query1 = "SELECT UIDN,fname,email FROM student WHERE UIDN={$reg};";
	$query2 = "SELECT UIDN,fname,email FROM teacher WHERE UIDN={$reg};";

	$result1 = mysqli_query($connection, $query1);
	$result2 = mysqli_query($connection, $query2);

	$row1 = mysqli_fetch_assoc($result1);
	$row2 = mysqli_fetch_assoc($result2);

	if (empty($row1)) {
		$_SESSION['UCLIN'] = $row2['fname'];
		$_SESSION['ROLE'] = "teacher";
		$_SESSION['EMAIL'] = $row2['email'];
		$_SESSION['UIDN'] = $row2['UIDN'];
		$returnJson['role'] = 'teacher';
	}else{
		$_SESSION['UCLIN'] = $row1['fname'];
		$_SESSION['ROLE'] = "student";
		$_SESSION['EMAIL'] = $row1['email'];
		$_SESSION['UIDN'] = $row1['UIDN'];
		$returnJson['role'] = 'student';
	}


	mysqli_free_result($result1);
	mysqli_free_result($result2);
	mysqli_close($connection);

	echo json_encode($returnJson);
	// header("location: ./student.php");
?>