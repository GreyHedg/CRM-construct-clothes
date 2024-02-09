<?php
    session_start();
    require_once('../db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Manage page</title>
    <link rel ="icon" href="../uploads/img/logo.png" />
    <link rel ="stylesheet" href="functions_page.css" />
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
                    <li><a = href = "functions_page.php" class = "login">Functions</a></li>
                </ul>
            </div>
        </div>
    </div>
    <ul class = "main-conteiner-fuctions">
        <li><a href = "session_page_admin.php"><button class = "function-button">Manage session</button></a></li>   
        <li><a href = "orders_page_admin.php"><button class = "function-button">Manage orders</button></a></li>    
        <li><a href = "products_page_admin.php"><button class = "function-button">Manage products</button></a></li>    
        <li><a href = "prints_page_admin.php"><button class = "function-button">Manage prints</button></a></li>    
        <li><a href = "workers_page_admin.php"><button class = "function-button">Manage workers</button></a></li>     
        <li><a href = "adapt-page.php"><button class = "function-button">Manage adaptation</button></a></li>             
    </ul>
    <script src="../index.js"></script>
</body>
</html>