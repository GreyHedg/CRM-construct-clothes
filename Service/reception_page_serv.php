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
    <title>Reception page</title>
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

        .search-box-container {
            text-align: center;
            margin-top: 20px;
        }

        .search-box {
            background-color: #d3d3d3;
            padding: 10px;
            border-radius: 10px;
            display: inline-block;
            margin-top: 20px;
        }

        .search-box label,
        .search-box input,
        .search-box button {
            font-size: 20px;
            margin: 5px;
            color: black;
            border: none;
            background-color: #d3d3d3;
        }

        .search-box input {
            background-color: white;
        }

        .search-box button {
            cursor: pointer;
        }
        

        .order-title {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .product-image {
            max-width: 100px;
            max-height: 100px;
        }
        .reception-button {
            cursor: pointer;
            font-size: 20px;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-top: 5px;
        }

        .no-orders {
            display: none; /* Скрытие блока, если нет заказов */
            list-style-type: none;
            font-size: 25px;
        }
        .order-box {
            background-color: #d3d3d3;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }

        .no-products {
            font-size: 20px;
            margin-top: 10px;
        }

        .no-image {
            font-size: 18px;
            margin-top: 10px;
        }
        .data-info {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .main-container {
            background-color: #d3d3d3;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            margin: 40px auto;
            max-width: 400px;
        }
        .orders-table {
            width: 70%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: center;
        }

        .orders-table th, .orders-table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .column-header {
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        .order-table {
            width: 70%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: center;
        }

        .order-table th, .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 16px;
        }

        .order-table th {
            background-color: #f2f2f2;
        }
        body {
            background-image: url('../uploads/img/<?= mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["background_image"] ?>');
            background-size: cover;
        }

        .function-button, .form-button, .function-button, .login, .login-button, .input-file span, .size-menu-button, .ready-button, .column-header, .reception-button, .confirm-button {
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

<div class="search-box-container">
    <div class="search-box">
        <h2 class="order-title">Ready orders</h2>
        <form method="GET" action="">
            <label for="search">Find:</label>
            <input type="text" name="search" id="search">
            <button type="submit">Search</button>
        </form>
    </div>
</div>

<?php


$search = isset($_GET['search']) ? $_GET['search'] : '';

// Формируем запрос к таблице project_orders с учетом поиска
$sql_orders = "SELECT orders.id AS order_id, orders.image, products.size, 
                      products.type_of_product, products.ready AS ready, 
                      prints.ready AS ready, prints.image_of_print
               FROM orders
               LEFT JOIN products ON orders.id = products.order_id
               LEFT JOIN prints ON orders.id = prints.order_id
               WHERE orders.id LIKE '%$search%'
                  OR products.size LIKE '%$search%'
                  OR products.type_of_product LIKE '%$search%'";

$result_orders = $connect->query($sql_orders);

// Обработка результатов запроса к таблице project_orders
if ($result_orders->num_rows > 0) {
    echo "<table class='orders-table'>
                <tr>
                    <th class='column-header'>Order ID</th>
                    <th class='column-header'>Size</th>
                    <th class='column-header'>Type</th>
                    <th class='column-header'>Name of print</th>
                    <th class='column-header'>Image</th>
                    <th class='column-header'>Order Status</th>
                    <th class='column-header'>Action</th>
                </tr>";

    while ($order = $result_orders->fetch_assoc()) {
        echo "<tr>
                    <td>{$order['order_id']}</td>
                    <td>{$order['size']}</td>
                    <td>{$order['type_of_product']}</td>
                    <td>{$order['image_of_print']}</td>
                    <td><img src='{$order['image']}' alt='Order Image' class='product-image'></td>
                    <td>";
        $sqlprintready = "SELECT * FROM prints WHERE order_id = ".$order['order_id'].";";
        $printready = $connect->query($sqlprintready);
        $printready = $printready->fetch_assoc();
        $sqlproductready = "SELECT * FROM products WHERE order_id = ".$order['order_id'].";";
        $productready = $connect->query($sqlproductready);
        $productready = $productready->fetch_assoc();
        if ($printready['ready'] == 1) {
            $sql = "UPDATE orders SET ready = 1 WHERE id = ".$order['order_id'].";";
            $connect->query($sql);
            echo "Ready";
        } elseif ($productready['ready'] == 1) {
            echo "The print is applied";
        } else {
            echo "Order is preparing";
        }

        echo "</td>
                    <td>
                        <form method='post' action='confirm.php'>
                            <input type='hidden' name='confirm' value='{$order['order_id']}'>
                            <button class='reception-button confirm-button' type='submit'>Confirm</button>
                        </form>
                    </td>
                  </tr>";
    }

    echo "</table>";
} else {
    echo "<div class='main-container'>
                <div class='data-info'> Debug: Search term - $search </div>
          </div>";
}



?>



<script src="../index.js"></script>
</body>

</html>