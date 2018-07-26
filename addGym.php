<?php

// Always start this first
session_start();

require('params.php');

echo "session started";

if ( ! empty( $_POST ) ) {
    
    $name = $_POST['name'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    

    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if($mysqli->connect_error) {
        exit('Error connecting to database'); //Should be a message a typical user could understand in production
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli->set_charset("utf8");
    
    $stmt = $mysqli->prepare("INSERT INTO gym (name, address, description, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $address, $description, $phone);
    $stmt->execute();
    $stmt->close();
    
    
    header("Location: /mygym/index.php");
    

}

?>