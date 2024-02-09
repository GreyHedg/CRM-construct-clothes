<?php

    session_start();
    require_once '../db.php';

    if (isset($_POST['orders'])) {
        switch ($_POST['orders']) {
            case 'check_all':
                $orders = mysqli_query($connect, "SELECT * FROM `orders`");
                if ($orders->num_rows > 0) {
                    $_SESSION['list'] = array();
                    while ($row = $orders->fetch_assoc()) {
                        $_SESSION['list'][] = $row;
                    }
                }
                header('Location: orders_page_admin.php#check_all');
                break;
            case 'search':
                $param = $_POST['param'];
                $value = $_POST['value'];
                $orders = mysqli_query($connect,"SELECT * FROM `orders` WHERE `".$param."` = '".$value."'");
                if (mysqli_num_rows($orders) != 0) {
                    $_SESSION[`orders`] = mysqli_fetch_array($orders);
                }
                else {
                    $_SESSION['message'] = "Error! Do not find order with these parameters";
                    header('Location: orders_page_admin.php#search');
                }
                break;
            case 'change':
                $id = $_POST['id'];
                $param = $_POST['param'];
                $value = $_POST['value'];
                $orders = mysqli_query($connect,"SELECT * FROM `orders` WHERE `".$param."` = '".$value."'");
                if (mysqli_num_rows($orders) != 0) {
                    mysqli_query($connect, "UPDATE `orders` SET `".$param."` = `".$value."` WHERE `id` = ".$id."");
                    header('Location: orders_page_admin.php');
                }
                else {
                    $_SESSION['message'] = "Error! Do not find order with this id";
                    header('Location: orders_page_admin.php#change');
                }
                break;
            case 'delete':
                $id = $_POST['id'];
                $check = mysqli_query($connect, "SELECT `id` FROM `orders` WHERE `id` = ".$id."");
                if (mysqli_num_rows($check) != 0) {
                    mysqli_query($connect, "DELETE FROM `orders` WHERE `id` = ".$id."");
                    header('Location: orders_page_admin.php');
                }
                else {
                    $_SESSION['message'] = 'Error! Do not find order with this id';
                    header('Location: orders_page_admin.php#delete');
                }
                break;
            case 'delete_all':
                mysqli_query($connect, "DELETE FROM `orders`");
                mysqli_query($connect, "ALTER TABLE `orders` AUTO_INCREMENT = 1");
                header('Location: orders_page_admin.php');
                break;
            }
    }
?>