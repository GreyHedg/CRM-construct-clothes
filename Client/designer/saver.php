<?php

session_start();

function base64_to_jpeg($base64_string, $output_file)  {
    $ifp = fopen($output_file, "wb");
    $data = explode(',', $base64_string);
    fwrite($ifp, base64_decode($data[1])); 
    fclose($ifp); 
    $_SESSION["url"] = $output_file;
    return $output_file; 
}


if (!empty($_POST))
{   
    $id = $_SESSION['order_id'];
    $_SESSION["positionX"] = $_POST["positionX"];
    $_SESSION["positionY"] = $_POST["positionY"];
    $_SESSION["angle"] = $_POST["angle"];
    $_SESSION["width"] = $_POST["width"];
    $_SESSION["height"] = $_POST["height"];
    $_SESSION['product'] = $_POST["product-name"];
    $_SESSION['print'] = $_POST["print-name"];
    $_SESSION['size'] = $_POST["size"];
    $generated  = str_replace('data:image/png;base64,', '', $_POST['image']);
    $generated = "data:image/png;base64,".$generated;
    base64_to_jpeg($generated, "..\\..\\uploads\\orders\\".$_SESSION['order_id'].".png");
    header("location: ../confirmation-page.php");
}

?>