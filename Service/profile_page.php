<?php
    session_start();
    if (!$_SESSION['user']) {
        header('Location: login_page.php');
    }
    else if ($_SESSION['user']['work_status'] == 'stop'){
        $_SESSION['message'] = 'Stop status';
    }
    require_once('../db.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Profile page</title>
    <link rel ="icon" href="../uploads/img/logo.png" />
    <link rel ="stylesheet" href="profile_page.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('../uploads/img/<?= mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["background_image"] ?>');
            background-size: cover;
        }

        .function-button, .form-button, .function-button, .login, .login-button, .input-file span, .size-menu-button, .ready-button {
            background-color: <?php 
                $color = '#cc00ad';
                $query = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["button_color"];
                if ($query != NULL) {
                    $color = $query;
                }
                echo $color;
                ?>;
        }
        
        .modal-window, .registration, .title-name, .delete-answer, .header_hr, h1, h2, .shopping-cart, p, .selected, .no-orders{
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
        .function-button{
            margin-left: 50%;
            transform: translate(-50%);
            margin-top: 40px;
            width: 300px;
            height: 60px;
            border-radius: 30px;
            font-size: 30px;
            color: white;
            border: none;
            cursor: pointer;
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
    </header>
    <div class = "registration-menu">
        <ul class = "autorization"> 
            <li class = "data-name">Login:</li>
            <li class = "data-value"><?= $_SESSION['user']['login'] ?></li>
            <li class = "data-name">Role:</li>
            <li class = "data-value"><?= $_SESSION['user']['role'] ?></li>
            <li class="error-login">
                <?php
                if ($_SESSION['message']) {
                    echo '<p> ' . $_SESSION['message'] . ' </p>';
                }
                unset($_SESSION['message']);
                ?>
            </li>
            <li><a href ="start_working.php"><button class = "function-button">Start working</button></a></li> 
            <li><a href ="logout.php"><button class = "function-button">Logout</button></a></li> 
        </ul>
    </div>
    <script src="../index.js"></script>
</body>
</html>