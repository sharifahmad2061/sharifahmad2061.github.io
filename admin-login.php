<?php

    if($_SERVER['REQUST_METHOD'] != 'POST'){
        die("only post requests are allowed");
    }
    include_once('./db_connection.php');
    

?>