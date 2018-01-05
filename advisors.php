<?php

    // if($_SERVER['REQUEST_METHOD'] != 'POST'){
    //     echo "the page does not work for \"GET\" requests.";
    //     return;
    // }

	//database connection
	$dbhost = "localhost";
	$dbuser = "sharif";
	$dbpass = "sharifahmad123";
	$dbname = "web_proj";

	$connection = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);

	if(mysqli_connect_errno()){
		die("db connection failed: ".mysqli_connect_error(). " (" . mysqli_connect_errno(). " )");
    }
    
    $query = "SELECT UIDN,CONCAT(fname,' ',lname) AS FULLNAME FROM teacher";

    $adv = mysqli_query($connection,$query);

    if(!$adv){
        die("mysql query error");
    }

    echo json_encode(mysqli_fetch_assoc($adv));

?>