<?php
session_start();

switch($_SESSION['user']['role']){
    case 'Issuing worker':
        header('Location: reception_page_serv.php');
        break;
    case 'Product manager':
        header('Location: product_page_serv.php');
        break;
    case 'Print manager':
        header('Location: print_page_serv.php');
        break;
    case 'Admin':
        header('Location: ../Admin/functions_page.php');
        break;
}

?>