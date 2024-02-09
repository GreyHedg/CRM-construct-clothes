<?php

    session_start();
    require_once '../db.php';

    if (isset($_POST['workers'])) {
        switch ($_POST['workers']) {
            case 'delete':
                $login = $_POST['name'];
                $check = mysqli_query($connect, "SELECT * FROM workers WHERE `login` = '".$login."'");
                if (mysqli_num_rows($check) != 0) {
                    mysqli_query($connect, "DELETE FROM workers WHERE `login` = '".$login."'");
                    header('Location: workers_page_admin.php');
                }
                else {
                    $_SESSION['message'] = 'Error! Do not find worker with this login';
                    header('Location: workers_page_admin.php#delete');
                }
                break;
            }
    }
?>