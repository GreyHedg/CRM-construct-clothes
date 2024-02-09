<?php

    session_start();
    require_once '../db.php';

    $login = $_POST['login'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password-confirm'];
    if (!empty($login) || !empty($role) || !empty($password)) {
        if ($password === $password_confirm) {
            $check_user = mysqli_query($connect, "SELECT * FROM `workers` WHERE `login` = '$login'");
            if (mysqli_num_rows($check_user) === 0) {
                $password = md5($password);
                mysqli_query($connect, "INSERT INTO `workers` (`id`, `login`, `role`, `pass`) VALUES (NULL, '$login', '$role', '$password')");
                header('Location: functions_page.php');
            } else {
                $_SESSION['message'] = 'Error! Login is already occupied';
                header('Location: registration_page_admin.php');
            }   
        } else {
            $_SESSION['message'] = 'Error! Passwords do not match';
            header('Location: registration_page_admin.php');
        }
    } else {
        $_SESSION['message'] = 'Error! All fields must be filled';
        header('Location: registration_page_admin.php');
    }
?>