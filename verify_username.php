<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	die("make post request");
}
else{
	include_once('./db_connection.php');
	$returnData = array();
	$query = "SELECT UIDN FROM sign_in";
	$result = mysqli_query($connection, $query);
	while($row = mysqli_fetch_assoc($result)){
		array_push($returnData, $row['UIDN']);
	}
	echo json_encode($returnData);
	mysqli_free_result($result);
	mysqli_close($connection);
}

?>