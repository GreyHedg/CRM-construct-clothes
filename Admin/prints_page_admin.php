<?php
    session_start();
    require_once('../db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Manage prints</title>
    <link rel="icon" href="../uploads/img/logo.png" />
    <link rel="stylesheet" href="prints_page_admin.css" />
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
        <li><a href = "#add"><button class = "function-button">Add print</button></a></li>    
        <li><a href = "#delete_all"><button class = "function-button">Delete all prints</button></a></li>
        <li><a href = "#delete"><button class = "function-button">Delete print</button></a></li>          
    </ul>
    <div class = "blackout" id = "add">
        <div class = "modal-window" class = "blackout" id = "modal-window">
            <ul class = "autorization">
                <form action = "manage_prints.php" method = "post" enctype="multipart/form-data">
                    <li class = "autorization-element-label">Enter name of print</li>
                    <li><input type = "text" class = "autorization-element-input" name = "filename"></li>
                    <li><label class="input-file"><input type = "file" class="input-file" name = "image"><span>Choose file</span></label></li>
                    <li><button type = "submit" class = "login-button" name = "prints" value = "add">Add</button></li>
                </form>
                <li><a href = "prints_page_admin.php" class = "login-button">Close</a></li>
            <!---<ul class = "autorization">
                <li><form action = "manage_prints.php" method = "post" class = "autorization-element-label">Enter name of product<input class = "autorization-element-input" type = "text" name = "filename"></form></li>
                <li><form action = "manage_prints.php" method="post" enctype="multipart/form-data"><label class="input-file"><input type="file" name="file"><span>Choose file</span></label></form></li>
                <li><form action = "manage_prints.php" method = "post"><button type = "submit" class = "login-button" name = "prints" value = "add">Add</button></form></li>
                <li><a href = "prints_page_admin.php"><button class = "login-button">Close</button></a></li>--->
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
                <li class = "delete-answer">Are you sure that you want delete all prints?</li>
                <li><form action = "manage_prints.php" method="POST"><button type = "submit" class = "login-button" name = "prints" value = "delete_all">Yes</button></form></li>  
                <li><a href = "prints_page_admin.php"><button class = "login-button">No</button></a></li>
            </ul>
        </div>
    </div>
    <div class = "blackout" id = "delete">
        <div class = "modal-window" class = "blackout" id = "modal-window">
            <ul class = "autorization">
            <form action = "manage_prints.php" method="post">
                <li class = "autorization-element-label">Enter name of print</li>
                <li><input class = "autorization-element-input" type = "text" name = "name"></li>
                <li><button type = "submit" class = "login-button" name = "prints" value = "delete">Delete</button></li>
            </form>
                <li><a href = "prints_page_admin.php"><button class = "login-button">Close</button></a></li>
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