<?php 
    session_start();
    require_once('../db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tablo page</title>
    <link rel="icon" href="../uploads/img/logo.png" />
    <link rel="stylesheet" href="reception_page_serv.css" />
    <script>
        // Обновление страницы каждые 10 секунд
        setInterval(function() {
            location.reload();
        }, 10000); // 10000 миллисекунд = 10 секунд
    </script>
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
            width: 80%;
            margin-bottom: 20px;
            margin-top: 40px;
            box-shadow: 0px 5px 10px 0px rgba(0,0,0,0.5);
        }

        .order-info {
            font-size: 18px;
            margin-bottom: 10px;
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

        .order-table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }

        .order-table th, .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 20px;
            width: 50%;
        }

        body {
            background-image: url('../uploads/img/<?= mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["background_image"] ?>');
            background-size: cover;
        }

        .function-button, .form-button, .function-button, .login, .login-button, .input-file span, .size-menu-button, .ready-button, .column-header, .reception-button, .confirm-button, .order-table th {
            background-color: <?php 
                $color = '#cc00ad';
                $query = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["button_color"];
                if ($query != NULL) {
                    $color = $query;
                }
                echo $color;
                ?>;
        }
        
        .modal-window, .registration, .title-name, .delete-answer, .header_hr, h1, h2, .shopping-cart, p, .selected, .no-orders, .order-title{
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

        .orders_images {
            width: 100px;
        }

        .ord{
            font-size: 50px;
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

<div class="order-container">
    <div class="order-box">
        <h2>Orders</h2>
        <table class="orders-table">
            <?php
           

            // Выбираем готовые заказы (ready = 1) и не готовые заказы (ready = 0) из базы данных
            $sql_ready = "SELECT * FROM orders WHERE ready = 1";
            $result_ready = $connect->query($sql_ready);

            $sql_not_ready = "SELECT * FROM orders WHERE ready = 0";
            $result_not_ready = $connect->query($sql_not_ready);

            $rows_ready = $result_ready->fetch_all(MYSQLI_ASSOC);
            $rows_not_ready = $result_not_ready->fetch_all(MYSQLI_ASSOC);

            $maxCount = max(count($rows_ready), count($rows_not_ready));

            echo "<table class='order-table'>";
            echo "<tr>";
            echo "<th>In Process</th>";
            echo "<th>Ready</th>";
            echo "</tr>";

            $maxCount = max(count($rows_not_ready), count($rows_ready));

            for ($i = 0; $i < $maxCount; $i++) {
                echo "<tr>";

                // Не готовые заказы
                echo "<td>";
                if (isset($rows_not_ready[$i])) {
                    echo "<div class = 'ord'>".$rows_not_ready[$i]['id']."</div>";
                    echo "<img src =".$rows_not_ready[$i]['image']." class = 'orders_images'>";
                }
                echo "</td>";

                // Готовые заказы
                echo "<td>";
                if (isset($rows_ready[$i])) {
                    echo "<div class = 'ord'>".$rows_ready[$i]['id']."</div>";
                    echo "<img src =".$rows_ready[$i]['image']." class = 'orders_images'>";
                }
                echo "</td>";

                echo "</tr>";
            }

            echo "</table>";

            echo "</table>";

            $connect->close();
            ?>
        </table>
    </div>
</div>
</body>

</html>
