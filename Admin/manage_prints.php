<?php
    session_start();
    require_once '../db.php';

    if (isset($_POST['prints'])) {
        switch ($_POST['prints']) {
            case 'add':
                if(isset($_FILES['image'])&& $_FILES['image']['error'] == 0){
                    $fileName = $_POST["filename"];
                    $targetFilePath = '../uploads/prints/'.$_FILES["image"]["name"]; 
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 

                    if($fileType === 'png'){  
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){ 
                            $insert = mysqli_query($connect, "INSERT INTO list_of_images (name, image) VALUES ('".$fileName."', '".$targetFilePath."')"); 
                            if($insert){
                                header('Location: prints_page_admin.php'); 
                            }else{ 
                                $_SESSION['message'] = "File upload failed, please try again"; 
                                header('Location: prints_page_admin.php#add');
                            }  
                        }else{ 
                            $_SESSION['message'] = "Sorry, there was an error uploading your file"; 
                            header('Location: prints_page_admin.php#add');
                        } 
                    }else{ 
                        $_SESSION['message'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload';  
                        header('Location: prints_page_admin.php#add');
                    } 
                }else{ 
                    $_SESSION['message'] = 'Please select a file to upload'; 
                    header('Location: prints_page_admin.php#add');
                } 
                break;
            case 'delete':
                $name = $_POST['name'];
                $check = mysqli_query($connect, "SELECT * FROM list_of_images WHERE `name` = '".$name."'");
                if (mysqli_num_rows($check) != 0) {
                    mysqli_query($connect, "DELETE FROM list_of_images WHERE `name` = '".$name."'");
                    header('Location: prints_page_admin.php');
                }
                else {
                    $_SESSION['message'] = 'Error! Do not find print with this name';
                    header('Location: prints_page_admin.php#delete');
                }
                break;
            case 'delete_all':
                mysqli_query($connect, "DELETE FROM list_of_images");
                mysqli_query($connect, "ALTER TABLE list_of_images AUTO_INCREMENT = 1");
                header('Location: prints_page_admin.php');
                break;
        }
    }
?>