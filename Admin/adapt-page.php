<?php
    session_start();
    require_once('../db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Adaptation Page</title>
    <link rel ="stylesheet" href="adapt-page.css" />
    <link rel ="icon" href="../uploads/img/logo.png" />
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
        
        .modal-window, .registration, .title-name, .delete-answer{
            color: <?php 
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
    </header>
    <main> 
        <ul class = "main-conteiner-functions">
            <li><a href = "#background-image"><button class = "function-button">Add background image</button></a></li>    
            <li><a href = "#logo"><button class = "function-button">Add logo</button></a></li> 
            <li><a href = "#title-name"><button class = "function-button">Add title name</button></a></li>    
            <li><a href = "#buttons-color"><button class = "function-button">Set buttons color</button></a></li>
        </ul>
        <div class = "main-functions" id = "background-image">
            <div class = "modal-window">
                <ul class = "autorization">
                <form action = "adaptation.php" method = "post" enctype = "multipart/form-data">
                    <li class = "autorization-element-label">Add file for background</li>
                    <li><label class="input-file"><input type = "file" class="input-file" name = "back-image"><span>Choose file</span></label></li>
                    <li><button class = "form-button" type = "submit" name = "functions" value = "background-image">Add image</button></li>
                </form>
                <li><a href = "adapt-page.php" class = "form-button">Close</a></li>
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
        </div> 
        <div class = "main-functions" id = "logo">
            <div class = "modal-window">
            <ul class = "autorization">
            <form action = "adaptation.php" method = "post" enctype = "multipart/form-data">
                <li class = "autorization-element-label">Add file for logo</li>
                <li><label class="input-file"><input type = "file" class="input-file" name = "logo-image"><span>Choose file</span></label></li>
                <li><button class = "form-button" type = "submit" name = "functions" value = "logo">Save</button></li> 
            </form>     
            <li><a href = "adapt-page.php" class = "form-button">Close</a></li>
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
        </div>
        <div class = "main-functions" id = "title-name">
            <div class = "modal-window">
            <ul class = "autorization">
            <form action = "adaptation.php" method = "post">
                <li class = "autorization-element-label">Add title name</li>
                <li><input class = "form-input-element" type = "text" name = "title-name"></li>
                <li><button class = "form-button" type = "submit" name = "functions" value = "title-name">Add title name</button></li>
            </form>
            <li><a href = "adapt-page.php" class = "form-button">Close</a></li>
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
        </div>
        <div class = "main-functions" id = "buttons-color">
            <div class = "modal-window">
            <ul class = "autorization">
            <form action = "adaptation.php" method = "post">
                <li class = "autorization-element-label">Choose color</li>
                <li><input class = "form-input-element" type = "color" name = "btn-color"></li>
                <li><button class = "form-button" type = "submit" name = "functions" value = "buttons-color">Set buttons color</button></li>
            </form>
            <li><a href = "adapt-page.php" class = "form-button">Close</a></li>  
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
        </div>
        

    </main>
    <script 
        src="../index.js">
    </script>
</body>