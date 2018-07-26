<?php
// Always start this first
session_start();

require("params.php");

$id;
$username;
$password;

if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['uid'] ) ) {
        
        $_SESSION['uid'] = $_POST['uid'];
        echo "done";
        
    }
}
?>