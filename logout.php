<?php

    session_start();
    session_destroy();
    header('Location: /mygym/login.html');
    exit;

?>