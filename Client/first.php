<?php
    session_start();
    require_once('../db.php');

    if (!isset($_SESSION['order_id'])) {
        $_SESSION['order_id'] = 0;
    }
    $res = 1;
    while ($res != 0) {
        $_SESSION['order_id']++;
        if ($_SESSION['order_id'] === 101){
            $_SESSION['order_id'] = 1;
        } 
        $x = $_SESSION['order_id'];
        $res = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM orders WHERE id = $x"));
    }
    mysqli_query($connect, "INSERT INTO orders (id) VALUES (".$_SESSION['order_id'].")");
    header('location: print_page.php');
?>