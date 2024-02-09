<?php
    session_start();
    require_once('../db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Manage products</title>
    <link rel="icon" href="../uploads/img/logo.png" />
    <link rel="stylesheet" href="products_page_admin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">
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
        <li><a href = "border_create_admin.php"><button class = "function-button">Add products</button></a></li>    
        <li><a href = "#delete_all"><button class = "function-button">Delete all products</button></a></li>
        <li><a href = "#delete"><button class = "function-button">Delete products</button></a></li>      
        <li><a href = "#change"><button class = "function-button" id = "big-button">Change count of products</button></a></li>            
    </ul>
    <div class = "blackout" id = "add">
        <div class = "modal-window" class = "blackout" id = "modal-window">
            <ul class = "autorization">
            <form action = "manage_products.php" method="post" enctype="multipart/form-data">
                <li class = "autorization-element-label">Enter name of product</li>
                <li><input class = "autorization-element-input" type = "text" name = "filename"></li>
                <li><label class="input-file">Front side<input type="file" name="image"></label></li>
                <li><button type = "submit" class = "login-button" name = "products" value = "add">Add</button></li>
                <li><a href = "products_page_admin.php"><button class = "login-button">Close</button></a></li>
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
        <div class = "modal-window" class = "blackout" id = "modal-window">
            <ul class = "autorization">
                <li class = "delete-answer">Are you sure that you want delete all orders?</li>
                <li><form action = "manage_products.php" method = "post"><button type = "submit" class = "login-button" name = "products" value = "delete_all">Yes</button></form></li>  
                <li><a href = "products_page_admin.php"><button class = "login-button">No</button></a></li>
            </ul>
        </div>
    </div>
    <div class = "blackout" id = "delete">
        <div class = "modal-window" class = "blackout" id = "modal-window">
            <ul class = "autorization">
            <form action = "manage_products.php" method="post">
                <li class = "autorization-element-label">Enter name of products</li>
                <li><input class = "autorization-element-input" type = "text" name = "id"></li>
                <li><button type = "submit" class = "login-button">Delete</button></li>
            </form>
                <li><a href = "products_page_admin.php"><button class = "login-button">Close</button></a></li>
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
    <div class = "blackout" id = "change">
        <div class = "modal-window" class = "blackout" id = "modal-window">
            <ul class = "autorization">
            <form action = "manage_products.php" method="post">
                <li class = "autorization-element-label">Enter name of products<input class = "autorization-element-input" type = "text" name = "name"></li>
                <li class = "autorization-element-label">Enter size of products<input class = "autorization-element-input" type = "text" name = "size"></li>
                <li class = "autorization-element-label">Enter count of products<input class = "autorization-element-input" type = "number" name = "count"></li>
                <li><button type = "submit" class = "login-button" name = "products" value = "change">Change</button></li>
            </form>
                <li><a href = "products_page_admin.php"><button class = "login-button">Close</button></a></li>
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
    <script src="../index.js"></script>
</body>
</html>