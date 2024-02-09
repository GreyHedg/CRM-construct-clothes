<?php
require_once '../db.php';


//код для обновления поля ready в базе данных
if (isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];

    // Подготавливаем запрос на обновление поля ready
    $updateSql = "UPDATE prints SET ready = 1 WHERE order_id = '$orderId'";

    if ($connect->query($updateSql)) {
        // Перенаправляем пользователя обратно на страницу с заказом
        header("Location: print_page_serv.php");
        exit();
    } else {
        echo "Error updating record: " . $con->error;
    }
}
?>