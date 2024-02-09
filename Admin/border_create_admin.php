<?php
    session_start();
    require_once('../db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Print designer</title>
    <link rel="icon" href="../uploads/img/logo.png" />
    <link rel="stylesheet" href="border_create_admin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">
    <script src="border_creator/jquery-2.1.3.min.js"></script>
    <script src="border_creator/fabric.js"></script>
    <script src="border_creator/javascrip.js"></script>
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
    <div id = "adding-product">
    <ul class = "autorization">
            <form action = "manage_products.php" method="post" enctype="multipart/form-data">
                <li class = "autorization-element-label">Enter name of product</li>
                <li><input class = "autorization-element-input" type = "text" name = "filename"></li>
                <li><label class="input-file"><span>Choose Image</span><input type="file" name="image" id = "design-upload"></label></li>
                <li><input class = "invisible" type = "number" name = "border_left" id = "border_left"></li>
                <li><input class = "invisible" type = "number" name = "border_top" id = "border_top"></li>                
                <li><input class = "invisible" type = "number" name = "border_width" id = "border_width"></li>
                <li><input class = "invisible" type = "number" name = "border_height" id = "border_height"></li>
                <li><button type = "submit" class = "login-button" name = "products" value = "add">Add</button></li>
            </form>
                <li><a href = "products_page_admin.php"><button class = "login-button">Close</button></a></li>
                <li class = "error-registration">  
                    <?php
                    if ($_SESSION['message']) {
                        echo '<p> ' . $_SESSION['message'] . ' </p>';
                    }
                    unset($_SESSION['message']);
                    ?>
                </li>
            </ul>
    </div>
    <div class = "construct_container">
        <div class = "hr" id = "right_hr">
            <div class = "header_hr">Constructor</div>
            <button class = "login-button" id = "saveimage">Save borders</button>
                <div id = "designer">
                    <canvas id="drawingCanvas"></canvas>
                </div>
        </div>
    </div>
</body>
</html>