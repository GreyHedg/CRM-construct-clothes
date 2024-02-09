<?php
    session_start();
    require_once('../db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Manage orders</title>
    <link rel="icon" href="../uploads/img/logo.png" />
    <link rel="stylesheet" href="orders_page_admi.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">
    <script src="../index.js"></script>
    <style>
        body {
            background-image: url('../uploads/img/<?= mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["background_image"] ?>');
            background-size: cover;
        }

        .function-button, .form-button, .function-button, .login, .login-button, .input-file span {
            background-color: <?php 
                $color = '#cc00ad';
                $query = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["button_color"];
                if ($query != NULL) {
                    $color = $query;
                }
                echo $color;
                ?>;
        }
        
        .modal-window, .registration, .title-name, .delete-answer, .header_hr{
            color: <?php 
                echo $color;
                ?>;
        }

        #drawingCanvas{
            box-shadow: 0 0 15px <?php 
                echo $color;
                ?>;
            border: 1px solid <?php 
                echo $color;
                ?>;
        }
    </style>
</head>
<body>
    <header>
        <div class = "conteiner">
            <div class = "title">
                <div class = "title-logo">
                    <?php 
                        if (file_exists('../uploads/img/logo.png')) {
                            echo '<image src = "../uploads/img/logo.png" class = "logo"></image>';
                        }
                    ?>
                </div>
                <div class = "title-name">
                    <?php 
                        echo mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["title_name"];
                    ?>
                </div>
            </div>
            <div class = "navigation">
                <ul class = "navigation-content">
                    <li><div class = "registration">Admin</div></li>
                    <li><a href = "functions_page.php" class = "login">Functions</a></li>
                </ul>
            </div>
        </div>
    </div>
    <ul class = "main-conteiner-fuctions" id = "main-conteiner-functions">
        <li><form action = "manage_orders.php" method="POST"><a href = "#check_all"><button type = "submit" class = "function-button" name = "orders" value = "check_all" >Check all orders</button></a></form></li>   
        <li><a href = "#search"><button class = "function-button">Search orders</button></a></li>    
        <li><a href = "#delete_all"><button class = "function-button">Delete all orders</button></a></li>   
        <li><a href = "#status"><button class = "function-button">Change order status</button></a></li>
        <li><a href = "#delete"><button class = "function-button">Delete order</button></a></li>   
        <li><a href = "../Client/first-page.php"><button class = "function-button">Create order</button></a></li>              
    </ul>
    <div class = "blackout" id = "status">
        <div class = "modal-window" id = "modal-window">
            <ul class = "autorization">
                <li><form action = "manage_orders.php" method="post" class = "autorization-element-label">Enter id of order<input class = "autorization-element-input" type = "number" name = "id"></li>
                <li><div class = "autorization-element-label">Enter parameter<input class = "autorization-element-input" type = "text" name = "param"></li>
                <li><div class = "autorization-element-label">Enter value<input class = "autorization-element-input" type = "text" name = "value"></form></li>
                <li><button type = "submit" class = "login-button">Change</button></li>
                <li><a href = "orders_page_admin.php"><button class = "login-button">Close</button></a></li>
                <li id = "error-registration-pass" class = "error-registration">  
                    <?php
                    if ($_SESSION['message']) {
                        echo '<p> ' . $_SESSION['message'] . ' </p>';
                    }
                    unset($_SESSION['message']);
                    ?>
                </li>
            </ul>
        </div>
    </div>
    <div class = "blackout" id = "delete_all">
        <div class = "modal-window" id = "modal-window">
            <ul class = "autorization">
                <li class = "delete-answer">Are you sure that you want delete all orders?</li>
                <li><form action = "manage_orders.php" method="POST"><button type = "submit" class = "login-button" name = "orders" value = "delete_all" >Yes</button></form></li>  
                <li><a href = "orders_page_admin.php"><button class = "login-button">No</button></a></li>
            </ul>
        </div>
    </div>
    <div class = "blackout" id = "search">
        <div class = "modal-window" id = "modal-window">
            <ul class = "autorization">
                <li><form action = "manage_orders.php" method="post" class = "autorization-element-label">Enter parameter<input class = "autorization-element-input" type = "text" name = "param"></form></li>
                <li><form action = "manage_orders.php" method="post" class = "autorization-element-label">Enter value<input class = "autorization-element-input" type = "text" name = "value"></form></li>
                <li><button type = "submit" class = "login-button">Search</button></li>
                <li><a href = "orders_page_admin.php"><button class = "login-button">Close</button></a></li>
                <li id = "error-registration-pass" class = "error-registration">  
                    <?php
                    if ($_SESSION['message']) {
                        echo '<p> ' . $_SESSION['message'] . ' </p>';
                    }
                    unset($_SESSION['message']);
                    ?>
                </li>
            </ul>
        </div>
    </div>
    <div class = "blackout" id = "delete">
        <div class = "modal-window" id = "modal-window">
            <ul class = "autorization">                
                <li><form action = "manage_orders.php" method="post" class = "autorization-element-label">Enter id of order<input class = "autorization-element-input" type = "number" name = "id"></form></li>
                <li><button type = "submit" class = "login-button">Delete</button></li>
                <li><a href = "orders_page_admin.php"><button class = "login-button">Close</button></a></li>
                <li id = "error-registration-pass" class = "error-registration">  
                    <?php
                    if ($_SESSION['message']) {
                        echo '<p> ' . $_SESSION['message'] . ' </p>';
                    }
                    unset($_SESSION['message']);
                    ?>
                </li>
            </ul>
        </div>
    </div>
    <div class = "blackout" id = "check_all">
        <div class = "modal-window" class = "blackout" id = "modal-window">
            <ul class = "list-of-orders">
            <?php
            $result = mysqli_query($connect, "SELECT * FROM orders");
            while ($orders = mysqli_fetch_assoc($result)) {
                $product = mysqli_query($connect, "SELECT * FROM products WHERE order_id = ".$orders['id']."");
                $product = mysqli_fetch_assoc($product);
                $print = mysqli_query($connect, "SELECT * FROM prints WHERE order_id = ".$orders['id']."");	
                $print = mysqli_fetch_assoc($print);
                echo "<li class = 'orders'>".$orders['id']." -> ".$product['type_of_product']." ".$product['size']." -> ".$print['image_of_print']." -> ".$orders['ready']."</li>";
            }
            ?>
            </ul>
            <a href = "orders_page_admin.php" class = "login-button">Close</a>
        </div>
    </div>
</body>
</html>