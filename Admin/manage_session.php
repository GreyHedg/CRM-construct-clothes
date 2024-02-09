<?php

    session_start();
    require_once '../db.php';

    if (isset($_POST['session'])) {
        switch ($_POST['session']) {
            case 'restart':
                mysqli_query($connect, "DELETE FROM `orders`");
                mysqli_query($connect, "ALTER TABLE `orders` AUTO_INCREMENT = 1");
                break;
            case 'stop':
                mysqli_query($connect, "UPDATE workers SET work_status = 'stop' WHERE work_status = 'online'");
                break;
            case 'run':
                mysqli_query($connect, "UPDATE workers SET work_status = 'online' WHERE work_status = 'stop'");
                break;
            }
    }
    header('Location: session_page_admin.php');
?>