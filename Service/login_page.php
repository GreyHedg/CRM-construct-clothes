<?php
    session_start();
    if ($_SESSION['user']) {
        header('Location: profile_page.php');
    }
    require_once('../db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Login page</title>
    <link rel ="icon" href="../uploads/img/logo.png" />
    <link rel ="stylesheet" href="login_page.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('../uploads/img/<?= mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["background_image"] ?>');
            background-size: cover;
        }

        .function-button, .form-button, .function-button, .login, .login-button, .input-file span, .size-menu-button {
            background-color: <?php 
                $color = '#cc00ad';
                $query = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["button_color"];
                if ($query != NULL) {
                    $color = $query;
                }
                echo $color;
                ?>;
        }
        
        .modal-window, .registration, .title-name, .delete-answer, .header_hr, h1, h2, .shopping-cart, p, .selected{
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
        
        #sl_ft img:hover{
            box-shadow: 0 0 15px <?php 
                echo $color;
                ?>;
            border: 1px solid <?php 
                echo $color;
                ?>;
        }

        #sd_ft img:hover{
            box-shadow: 0 0 15px <?php 
                echo $color;
                ?>;
            border: 1px solid <?php 
                echo $color;
                ?>;
        }

        .have:hover{
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
        </div>
    </div>
    <div class = "login-menu">
        <ul class = "autorization">
            <li><form action = "login.php" method="post" class = "autorization-element-label">Login</label><input id = "login" class = "autorization-element-input" type = "text" name = "login"></li>
            <li><form action = "login.php" method="post" class = "autorization-element-label">Password</label><input id = "password" class = "autorization-element-input" type = "text" name = "password"></li>
            <li><button type = "submit" class = "login-button">Login</button></li>
            <li class="error-login">
                <?php
                if ($_SESSION['message']) {
                    echo '<p> ' . $_SESSION['message'] . ' </p>';
                }
                unset($_SESSION['message']);
                ?>
            </li>
        </ul>
    </div>
    <script src="index.js"></script>
</body>
</html>