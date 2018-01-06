<?php

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        echo "the page does not work for \"GET\" requests.";
        return;
    }

    include_once "db_connection.php";

    $returnJson = array();
    
    $query = "SELECT UIDN,CONCAT(fname,' ',lname) AS FULLNAME FROM teacher";

    $adv = mysqli_query($connection,$query);

    if(!$adv){
        die("mysql query error");
    }

    while($res = mysqli_fetch_assoc($adv)){
        $returnJson[$res['UIDN']] = $res['FULLNAME'];
    }

    echo json_encode($returnJson);

?>