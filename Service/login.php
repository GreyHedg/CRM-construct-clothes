<?php

    session_start();
    require_once '../db.php';

    $login = $_POST['login'];
    $password = md5($_POST['password']);
    $check_user = mysqli_query($connect, "SELECT * FROM `workers` WHERE `login` = '$login' AND `pass` = '$password'");
    if (mysqli_num_rows($check_user) > 0) {
        if($login != "Admin"){
            mysqli_query($connect, "UPDATE `workers` SET `work_status` = 'online' WHERE `login` = '$login';");
        }
        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "login" => $user['login'],
            "role" => $user['role'],
        ];

        header('Location: profile_page.php');

    } else {
        $_SESSION['message'] = 'Error! Uncorrect login or password';
        header('Location: login_page.php');
        
    }
?>