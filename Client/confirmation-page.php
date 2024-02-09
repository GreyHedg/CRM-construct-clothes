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
    <title>Confirmation Page</title>
    <link rel ="stylesheet" href="css/styles.css" />
    <link rel ="stylesheet" href="css/confirmation-page.css" />
    <link rel ="icon" href="../uploads/img/logo.png" />
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
    </header>
    <main>
        <div class = "order-wrap">
            <div class = "order">
                <div class = "shopping-cart">
                    <h3>Shopping Cart</h3>
                </div>
                <div class = "product">
                    <?php 
                    $request = mysqli_query($connect, "SELECT * FROM list_of_products WHERE name = '".$_SESSION['product']."'");
                    if (mysqli_num_rows($request) > 0)
                    {
                        $row_product = mysqli_fetch_assoc($request);
                        $product_img =  $row_product['front_image'];

                    }
                    $product_size = str_replace('_', '', $_SESSION['size']); // вывод размера без символа _
                    ?>
                    <img src= "<?= $product_img ?>" class = "product-image">
                    <p><?= $_SESSION['product'].', '.$product_size ?></p>
                </div>
                <div class = "print">
                    <?php
                    $request = mysqli_query($connect, "SELECT * FROM list_of_images WHERE name = '".$_SESSION['print']."'");
                    if (mysqli_num_rows($request) > 0)
                    {
                        $row_print = mysqli_fetch_assoc($request);
                        $print_img = $row_print['image'];
                    }
                    ?>
                    <img src= "<?= $print_img ?>" class = "print-image">
                    <p><?= $_SESSION['print'] ?></p>
                </div>
                <div class = "generated-item">
                    <img src = "../uploads/orders/<?= $_SESSION['order_id'] ?>.png" class = "created-image">
                    <p>Your final item</p>
                </div>
                <a class = "order-confirm-button" href = "conf.php">Confirm order</a>
            </div>
        </div>  
    </main>
    <script src="../index.js"></script>
</body>