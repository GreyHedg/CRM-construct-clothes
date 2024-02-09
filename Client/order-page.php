<?php 
    session_start();
    require_once('../db.php');

    //if(!$_SESSION['order_id']){
    //    header("location: first-page.php");
    //}
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Order Page</title>
    <link rel ="stylesheet" href="css/styles.css" />
    <link rel ="stylesheet" href="css/order-page.css" />
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
        
        .modal-window, .registration, .title-name, .delete-answer, .header_hr, h1, h2, .order-id, .soon-delivery{
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
    <main>
        <div class = "order-frame">
            <div class = "cart-image">
                <img src = "../uploads/img/basket.png" alt = "Basket" style = "height: 80px; weight: 80px;">
            </div>
            <div class = "order-id">
            <p>Your order ID is #<?= $_SESSION['order_id'] ?></p>
            </div>
            <div class = "soon-delivery">
                <p>It will be ready for issuance soon</p>
            </div>
            <a class = "another-order-btn" href = "first-page.php">Make an another order</a>
        </div>
    </main>
    <script src="../index.js"></script>
</body>