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

	include_once('./db_connection.php');

	$query = "SELECT * FROM sign_in WHERE uidn={$reg} AND password='{$pass}';";
	$result = mysqli_query($connection, $query);

	$row = mysqli_fetch_assoc($result);
	if (empty($row)) {	//if no user login data is incorrect
		$returnJson['success'] = 'false';
		die(json_encode($returnJson));
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
		// $returnJson['sess'] = 'teacher';
		// echo "setting sessions variables for teacher";
		$_SESSION['UCLIN'] = $row2['fname'];
		$_SESSION['ROLE'] = "teacher";
		$_SESSION['EMAIL'] = $row2['email'];
		$_SESSION['UIDN'] = $row2['UIDN'];

		setcookie('UCLIN',$_SESSION['UCLIN'],time()+3600);
		setcookie('ROLE',$_SESSION['ROLE'],time()+3600);
		setcookie('EMAIL',$_SESSION['EMAIL'],time()+3600);
		setcookie('UIDN',$_SESSION['UIDN'],time()+3600);


		$returnJson['role'] = 'teacher';
	}else{
		// $returnJson['sess'] = 'student';
		// echo "setting session variables for student";
		$_SESSION['UCLIN'] = $row1['fname'];
		$_SESSION['ROLE'] = "student";
		$_SESSION['EMAIL'] = $row1['email'];
		$_SESSION['UIDN'] = $row1['UIDN'];


		setcookie('UCLIN',$_SESSION['UCLIN'],time()+3600);
		setcookie('ROLE',$_SESSION['ROLE'],time()+3600);
		setcookie('EMAIL',$_SESSION['EMAIL'],time()+3600);
		setcookie('UIDN',$_SESSION['UIDN'],time()+3600);


		$returnJson['role'] = 'student';
		$returnJson['UIDN'] = $_SESSION['UIDN'];
	}


	mysqli_free_result($result1);
	mysqli_free_result($result2);
	mysqli_close($connection);
	// print_r($_SESSION);
	echo json_encode($returnJson);
	// header("location: ./student.php");
?>