<?php

// Always start this first
session_start();

require('params.php');

echo "session started";

if ( ! empty( $_POST ) ) {
    
    $bookID = $_POST['bookID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $profileLink = $_POST['profileLink'];
    $address = $_POST['address'];
    $profileType = 0;
    $sent = 0;
    $note = $_POST['note'];
    
    if($_POST['profileType'] == 'Instagram')
        $profileType = 1;
    else if($_POST['profileType'] == 'Website')
        $profileType = 2;
    
    if($_POST['sent'] == 'Poslato')
        $sent = 1;
    
    echo "jovan ";
    echo $firstName . " " . $lastName . " " . $profileLink . " " . $address . " " . $profileType . " " . $sent . " " . $note;
    

    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if($mysqli->connect_error) {
        exit('Error connecting to database'); //Should be a message a typical user could understand in production
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli->set_charset("utf8");
    
    $stmt = $mysqli->prepare("UPDATE book SET first_name = ?, last_name = ?, profile_link = ?, address = ?, profile_type = ?, sent = ?, note = ? WHERE book_id = ?");
    $stmt->bind_param("ssssiisi", $firstName, $lastName, $profileLink, $address, $profileType, $sent, $note, $bookID);
    $stmt->execute();
    $stmt->close();
    
    $bookID += 1;
    
    header("Location: /knjige/index.php#$bookID");
    

}

?>