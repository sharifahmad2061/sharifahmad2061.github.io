<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
	}
	else{
		echo "the page does not work for \"GET\" requests.";
		return;
	}

	//received information
	$uidn = $_POST['uidn'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$role = $_POST['role'];
	$pass = $_POST['psd'];
	$adv = $_POST['advisor_id'];

	// var_dump($uidn, $fname, $lname, $email, $role, $pass);

	//database connection
	$dbhost = "localhost";
	$dbuser = "sharif";
	$dbpass = "sharifahmad123";
	$dbname = "web_proj";

	$connection = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);

	if(mysqli_connect_errno()){
		die("db connection failed: ".mysqli_connect_error(). " (" . mysqli_connect_errno(). " )");
	}

	if ($role == "student") {
		$query = "INSERT INTO student(UIDN,fname,lname,email,advisor_id) VALUES({$uidn},'{$fname}','{$lname}','{$email}','{$adv}')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "student query failed ".mysqli_error($connection)."\n";}

		$query = "INSERT INTO sign_in (UIDN,password) VALUES({$uidn},'{$pass}')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "sign in query failed".mysqli_error($connection)."\n";}
		
		$query = "INSERT INTO user_status (u_id,status) VALUES({$uidn},'online')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "user status query failed".mysqli_error($connection)."\n";}
		
		echo "data written to the student database";
	
	} else {
		$query = "INSERT INTO teacher (UIDN,fname,lname,email) VALUES({$uidn},'{$fname}','{$lname}','{$email}')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "teacher query failed".mysqli_error($connection)."\n";}

		$query = "INSERT INTO sign_in (UIDN,password) VALUES({$uidn},'{$pass}')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "sign in query failed".mysqli_error($connection)."\n";}

		$query = "INSERT INTO user_status (u_id,status) VALUES({$uidn},'online')";
		$result = mysqli_query($connection,$query);
		if(!$result){echo "user status query failed".mysqli_error($connection)."\n";}

		echo "data written to the teacher database";
	}
	

	$_SESSION['UCLIN'] = $fname;
	$_SESSION['ROLE'] = $role;
	$_SESSION['EMAIL'] = $email;
	$_SESSION['UIDN'] = $uidn;

	mysqli_close($connection);
?>