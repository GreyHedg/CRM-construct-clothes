<?php

    session_start();
    require_once '../db.php';
    $login = $_SESSION['user']['login'];
    mysqli_query($connect, "UPDATE `workers` SET `work_status` = 'offline' WHERE `login` = '$login';");
    unset($_SESSION['user']);
    header('Location: login.php');
?>