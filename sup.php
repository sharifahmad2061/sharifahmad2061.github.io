<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
	}
	else{
		echo "the page does not work for \"GET\" requests.";
		return;
	}

	//return data
	$returnData = array();

	//received information
	$uidn = $_POST['uidn'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$role = $_POST['role'];
	$pass = $_POST['psd'];
	if($role == 'student'){
		$adv = $_POST['advisor_id'];
		$section = $_POST['section'];
	}

	include_once('./db_connection.php');

	if ($role == "student") {
		$query = "INSERT INTO student(UIDN,fname,lname,email,advisor_id,section) VALUES({$uidn},'{$fname}','{$lname}','{$email}','{$adv}', '{$section}')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "student query failed ".mysqli_error($connection)."\n";return;}

		$query = "INSERT INTO sign_in (UIDN,password) VALUES({$uidn},'{$pass}')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "sign in query failed".mysqli_error($connection)."\n";return;}
		
		$query = "INSERT INTO user_status (u_id,status) VALUES({$uidn},'online')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "user status query failed".mysqli_error($connection)."\n";return;}
		
		// echo "data written to the student database";
		$returnData['success'] = 'true';
		$returnData['role'] = 'student';
		
	} else {
		$query = "INSERT INTO teacher (UIDN,fname,lname,email) VALUES({$uidn},'{$fname}','{$lname}','{$email}')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "teacher query failed".mysqli_error($connection)."\n";return;}

		$query = "INSERT INTO sign_in (UIDN,password) VALUES({$uidn},'{$pass}')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "sign in query failed".mysqli_error($connection)."\n";return;}

		$query = "INSERT INTO user_status (u_id,status) VALUES({$uidn},'online')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "user status query failed".mysqli_error($connection)."\n";return;}

		$returnData['success'] = 'true';
		$returnData['role'] = 'teacher';
		// echo "data written to the teacher database";
	}
	

	$_SESSION['UCLIN'] = $fname;
	$_SESSION['ROLE'] = $role;
	$_SESSION['EMAIL'] = $email;
	$_SESSION['UIDN'] = $uidn;

	setcookie('UCLIN',$fname,time()+3600);
	setcookie('ROLE',$role,time()+3600);
	setcookie('EMAIL',$email,time()+3600);
	setcookie('UIDN',$uidn,time()+3600);

	echo json_encode($returnData);

	mysqli_close($connection);
?>