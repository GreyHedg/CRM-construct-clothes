<?php
    session_start();
    require_once('../db.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Registration page</title>
    <link rel ="icon" href="../uploads/img/logo.png" />
    <link rel ="stylesheet" href="registration_page_admin.css" />
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
    <div class = "registration-menu">
        <ul class = "autorization">
            <li><div class = "autorization-element-label">Register new workers</div></li>  
            <li><form action = "registration.php" method="post" class = "autorization-element-label">Login<input id = "login" class = "autorization-element-input" type = "text" name = "login"></li>
            <li><div>
                    <div id="dropdown" style = "cursor: pointer;">Choose role</div>
                    <ul id="dropdownMenu" style = "display: none;">
                        <li style = "cursor: pointer;" name = "Issuing worker">Issuing worker</li>
                        <li style = "cursor: pointer;" name = "Product manager">Product manager</li>
                        <li style = "cursor: pointer;" name = "Print manager">Print manager</li>
                    </ul>
                    <input id = "role" type = "text" name = "role" style = "display: none;">
                </div></li>
            <li>Password<input id = "password" class = "autorization-element-input" type = "text" name = "password"></li>
            <li>Confirm password<input id = "password-confirm" class = "autorization-element-input" type = "text" name = "password-confirm"></li>
            <li><button type = "submit" class = "login-button">Register</button></li></form>
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
    <script src="../index.js"></script>
    <script src="border_creator/jquery-2.1.3.min.js"></script>
    <script>
        $('#dropdown').click(function() {
            var menu = document.getElementById('dropdownMenu');
            if (menu.style.display === 'none') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        });
        
        $('#dropdownMenu li').click(function() {
            var menu = document.getElementById('dropdownMenu');
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            }
            var paragraph = document.getElementById('dropdown');
            paragraph.textContent = $(this).attr('name');
            $("#role").val($(this).attr('name'));
        });
    </script>
</body>
</html>