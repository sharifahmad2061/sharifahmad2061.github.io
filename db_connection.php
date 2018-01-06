<?php

//database connection
$dbhost = "localhost";
$dbuser = "sharif";
$dbpass = "sharifahmad123";
$dbname = "web_proj";

$connection = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);

if(mysqli_connect_errno()){
	die("db connection failed: ".mysqli_connect_error(). " (" . mysqli_connect_errno(). " )");
}


?>