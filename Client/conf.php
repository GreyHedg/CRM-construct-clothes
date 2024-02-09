<?php

    session_start();
    require_once('../db.php');

    $id = $_SESSION['order_id'];
    $product = $_SESSION["product"];
    $print = $_SESSION["print"];
    $size = $_SESSION["size"];
    $positionX = $_SESSION["positionX"];
    $positionY = $_SESSION["positionY"];
    $angle = $_SESSION["angle"];
    $width = $_SESSION["width"];
    $height = $_SESSION["height"];
    
    mysqli_query($connect, "INSERT INTO orders (id, image, ready) VALUES (".$id.", '../uploads/orders/".$id.".png', 0);");
    mysqli_query($connect, "INSERT INTO products (id, type_of_product, size, ready, order_id) VALUES (NULL, '".$product."', '".$size."', 0, ".$id.");");
    mysqli_query($connect, "INSERT INTO prints (id, image_of_print, positionX, positionY, ready, order_id, angle_of_inclination, width, height) VALUES (NULL, '".$print."', ".$positionX.", ".$positionY.", 0, ".$id.", ".$angle.", ".$width.", ".$height.");");
    $count = mysqli_fetch_assoc(mysqli_query($connect, "SELECT `_".$size."` FROM list_of_products WHERE `name` = '".$product."';"));
    echo $count['_'.$size];
    mysqli_query($connect, "UPDATE list_of_products SET `_".$size."` = ".($count['_'.$size]-1)." WHERE `name` = '".$product."'");    
    header("location: order-page.php");
?>    