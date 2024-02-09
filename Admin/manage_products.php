<?php

    session_start();
    require_once '../db.php';

    if (isset($_POST['products'])) {
        switch ($_POST['products']) {
            case 'add':
                if(isset($_FILES['image'])&& $_FILES['image']['error'] == 0){
                    $fileName = $_POST["filename"];
                    $targetFilePath = '../uploads/products/'.$_FILES["image"]["name"]; 
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 

                    if($fileType === 'png'){  
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){ 
                            if ($_POST['border_left']){
                                $border_left = $_POST['border_left'];
                                $border_top = $_POST['border_top'];
                                $border_width = $_POST['border_width'];
                                $border_height = $_POST['border_height'];
                                $insert = mysqli_query($connect, "INSERT INTO list_of_products (name, front_image, border_height, border_width, border_left, border_top) VALUES ('".$fileName."', '".$targetFilePath."', '".$border_height."', '".$border_width."', '".$border_left."', '".$border_top."')"); 
                                if($insert){
                                    header('Location: products_page_admin.php'); 
                                }else{ 
                                    $_SESSION['message'] = "File upload failed, please try again"; 
                                    header('Location: border_create_admin.php');
                                } 
                            } else{
                                $_SESSION['message'] = "Error! Add borders";
                                header('Location: border_create_admin.php');
                        }
                        }else{ 
                            $_SESSION['message'] = "Sorry, there was an error uploading your file"; 
                            header('Location: border_create_admin.php');
                        } 
                    }else{ 
                        $_SESSION['message'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload';  
                        header('Location: border_create_admin.php');
                    } 
                }else{ 
                    $_SESSION['message'] = 'Please select a file to upload'; 
                    header('Location: border_create_admin.php');
                } 
                break;
            case 'change':
                $name = $_POST['name'];
                $size = $_POST['size'];
                $count = $_POST['count'];
                $products = mysqli_query($connect,"SELECT * FROM list_of_products WHERE `name` = '".$name."'");
                if (mysqli_num_rows($products) != 0) {
                    mysqli_query($connect, "UPDATE list_of_products SET `_".$size."` = ".$count." WHERE `name` = '".$name."'");
                    header('Location: products_page_admin.php');
                }
                else {
                    $_SESSION['message'] = "Error! Do not find print with this id";
                    header('Location: products_page_admin.php#change');
                }
                break;
            case 'delete':
                $name = $_POST['name'];
                $check = mysqli_query($connect, "SELECT * FROM list_of_products WHERE `name` = '".$name."'");
                if (mysqli_num_rows($check) != 0) {
                    mysqli_query($connect, "DELETE FROM list_of_products WHERE `name` = '".$name."'");
                    header('Location: products_page_admin.php');
                }
                else {
                    $_SESSION['message'] = 'Error! Do not find product with this name';
                    header('Location: products_page_admin.php#delete');
                }
                break;
            case 'delete_all':
                mysqli_query($connect, "DELETE FROM list_of_products");
                mysqli_query($connect, "ALTER TABLE list_of_products AUTO_INCREMENT = 1");
                header('Location: products_page_admin.php');
                break;
            }
    }
?>

<script>
    var fileBackground = "<?php echo $targetFilePath?>";
</script>
<script src = "border_creator/javascrip.js"></script>