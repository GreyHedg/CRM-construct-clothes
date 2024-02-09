<?php
require_once('../db.php');
if (isset($_POST['confirm'])) {
    $confirmedOrderId = $_POST['confirm'];

    $deletePrintsSql = "DELETE FROM prints WHERE order_id = '$confirmedOrderId'";
    if ($connect->query($deletePrintsSql) === TRUE) {

        $deleteProductsSql = "DELETE FROM products WHERE order_id = '$confirmedOrderId'";
        if ($connect->query($deleteProductsSql) === TRUE) {

            $deleteOrderSql = "DELETE FROM orders WHERE id = '$confirmedOrderId'";
            if ($connect->query($deleteOrderSql) === TRUE) {
                header('location: reception_page_serv.php');
            } else {
                echo "Error deleting record from project_orders: " . $connect->error;
            }

        } else {
            echo "Error deleting record from projects_products: " . $connect->error;
        }

    } else {
        echo "Error deleting record from project_prints: " . $connect->error;
    }
}
?>