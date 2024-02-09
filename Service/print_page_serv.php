<?php 
    session_start();
    require_once('../db.php');

    $sql = mysqli_query($connect, "SELECT * FROM workers WHERE login = '".$_SESSION['user']['login']."';");
    $sql = $sql->fetch_assoc();
    if ($sql['work_status'] == 'stop'){
        $_SESSION['message'] = 'Stop status';
        header('Location: profile_page.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print service page</title>
    <link rel="icon" href="../uploads/img/logo.png" />
    <link rel="stylesheet" href="reception_page_serv.css" />
    <style>
        body {
            color: black;
            background-color: white;
            transition: all 1s ease;
        }

        .body-night-mode {
            color: white;
            background-color: #373737;
        }

        .order-container {
            text-align: center;
            margin-top: 20px;
        }

        .order-box {
            background-color: #d3d3d3;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }

        .order-info {
            font-size: 25px;
            margin-bottom: 20px;
        }

        .image-container {
            max-width: 100%;
            margin-bottom: 20px;
        }

        .ready-button {
            cursor: pointer;
            font-size: 20px;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }
        .no-orders {
            display: none;
            list-style-type: none;
            font-size: 25px;
        }
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
        
        .print-image{
            width:200px;
        }

        .function-button{
            margin-top: 35%;
            transform: translate(0, -50%);
            margin-right: 40px;
            width: 100px;
            height: 40px;
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
            <a href ="profile_page.php"><button class = "function-button">End</button></a> 
        </div>
    </header>

<div class="order-container">
    <div class="order-box">
        <?php

        // выбор заказа из базы данных по наименьшему order_id и ready = 0
        $sql = "SELECT * FROM prints WHERE ready = 0 ORDER BY order_id LIMIT 1";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idd = $row["order_id"];

            $sql_list_of_images = "SELECT * FROM list_of_images WHERE name = '" . $row["image_of_print"] . "'";
            $images = $connect->query($sql_list_of_images);
            $images = $images->fetch_assoc();

            $sql_list_of_order = "SELECT * FROM orders WHERE id = '" . $row["order_id"] . "'";
            $orders = $connect->query($sql_list_of_order);
            $orders = $orders->fetch_assoc();

            echo "<div class='order-box'>";
            echo "<div class='image-container'><img src='" . $images["image"] . "' alt='Print Image' class='print-image'></div>";
            echo "<div class='image-container'><img src='" . $orders["image"] . "' alt='Print Image' class='print-image'></div>";


            if ($images->num_rows > 0) {
                $image = $images->fetch_assoc();
                echo "<div class='order-info'>Name of print: " . $image["name"] . "</div>";
            }

            echo "<div class='order-info'>Order ID: " . $row["order_id"] . "</div>";
            echo "<div class='order-info'>PositionX: " . $row["positionX"] . "</div>";
            echo "<div class='order-info'>PositionY: " . $row["positionY"] . "</div>";
            echo "<div class='order-info'>Angle of inclination: " . $row["angle_of_inclination"] . "</div>";
            echo "<div class='order-info'>Height: " . $row["height"] . "</div>";
            echo "<div class='order-info'>Width: " . $row["width"] . "</div>";

            $sql_products = "SELECT type_of_product FROM projects_products WHERE order_id = '$idd'";
            $result_products = $connect->query($sql_products);

            // Обработка результатов запроса к таблице projects_products
            if ($result_products->num_rows > 0) {
                $product = $result_products->fetch_assoc();

                $sql_list = "SELECT * FROM list_of_products WHERE name = '" . $product["type_of_product"] . "'";
                $result = $connect->query($sql_list);

                if ($result->num_rows > 0) {
                    $rows = $result->fetch_assoc();
                    echo "<div class='order-info'>Type of product: " . $rows["name"] . "</div>";
                }
            }
            echo '<form method="post" action="print.php">';
            echo '    <input type="hidden" name="order_id" value="' . $row['order_id'] . '">';
            echo '    <button class="ready-button" type="submit">READY</button>';
            echo '</form>';
        } else {
            echo "<div class='main-container'>";
            echo "<div class='data-info'> No order found. </div>";
            echo "</div>";
        }
        ?>

    </div>
</div>
</body>

</html>