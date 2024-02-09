<?php 
    session_start();
    require_once('../db.php');
    if (isset($_POST['functions'])) {
        if(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM adaptive_info")) == 0)
        {
            mysqli_query($connect, "INSERT INTO adaptive_info (id) VALUES (1)");
        }
        switch($_POST['functions']) {
            case 'background-image':
                if (isset($_FILES['back-image']) && $_FILES['back-image']['error'] == 0) {
                    $targetPath = '../uploads/img/'.$_FILES['back-image']['name'];
                    move_uploaded_file($_FILES['back-image']['tmp_name'], $targetPath);
                    mysqli_query($connect, "UPDATE adaptive_info SET background_image = '".$_FILES['back-image']['name']."' WHERE id = 1");
                }
                else {
                    $_SESSION['message'] = "File upload failed, please try again.";
                    header('location: adapt-page.php#backround-image');
                }
                break;
            case 'logo':
                if (isset($_FILES['logo-image']) && $_FILES['logo-image']['error'] == 0) {
                    $fileType = pathinfo($_FILES['logo-image']['name'])['extension'];
                    if ($fileType === 'png') {
                        $targetPath = '../uploads/img/logo.png';
                        move_uploaded_file($_FILES['logo-image']['tmp_name'], $targetPath);
                    }
                    else {
                        $_SESSION['message'] = "Sorry, only PNG files are allowed to upload.";
                        header('location: adapt-page.php#logo');
                    }
                }
                else {
                    $_SESSION['message'] = "File upload failed, please try again.";
                    header('location: adapt-page.php#logo');
                }
                break;
            case 'title-name':
                if(!empty($_POST['title-name'])){
                    mysqli_query($connect, "UPDATE adaptive_info SET title_name = '".$_POST['title-name']."' WHERE id = 1");
                }
                else {
                    $_SESSION['message'] = "The label is empty. Enter a correct name.";
                    header('location: adapt-page.php#title-name');
                }
                break;
            case 'buttons-color':
                if($_POST['btn-color'] !== '#000000') {
                    mysqli_query($connect, "UPDATE adaptive_info SET button_color = '".$_POST['btn-color']."' WHERE id = 1");
                }
                else {
                    $_SESSION['message'] = "The color of buttons wasn't selected, so the default color is used.";
                }
                break;
        }
    }
    header('location: adapt-page.php');
?>