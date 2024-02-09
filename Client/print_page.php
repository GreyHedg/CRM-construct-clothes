<?php
    session_start();
    require_once('../db.php');

    //if(!$_SESSION['order_id']){
    //    header("location: first-page.php");
    //}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Print page</title>
    <link rel="icon" href="../uploads/img/logo.png" />
    <link rel="stylesheet" href="css/print_page_styl.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">
    <script src="designer/jquery-2.1.3.min.js"></script>
    <script src="designer/fabric.js"></script>
    <script src="../index.js"></script>
    <style>
        body {
            background-image: url('../uploads/img/<?= mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["background_image"] ?>');
            background-size: cover;
        }

        .function-button, .form-button, .function-button, .login, .login-button, .input-file span, .size-menu-button {
            background-color: <?php 
                $color = '#cc00ad';
                $query = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM adaptive_info WHERE id = 1"))["button_color"];
                if ($query != NULL) {
                    $color = $query;
                }
                echo $color;
                ?>;
        }
        
        .modal-window, .registration, .title-name, .delete-answer, .header_hr, h1, h2, .shopping-cart, p, .selected{
            color: <?php 
                echo $color;
                ?>;
        }
        
        #sl_ft img:hover, #sd_ft img:hover, .have:hover, #drawingCanvas{
            box-shadow: 0 0 15px <?php 
                echo $color;
                ?>;
            border: 1px solid <?php 
                echo $color;
                ?>;
        }
    </style>
</head>
<body>
    <div class = "header">
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
    </div>
    <div class ="construct_container">
            <div class="hr" id = "left_hr">
                <div id = "designer">
                    <canvas id="drawingCanvas" width = "500" height = "100"></canvas>
                </div>
            </div>
            <div class="hr" id = "right_hr">
                <div class="header_hr" id = "first_header">Products</div>
                <div id="sl_ft">
                    <?php
                        $i = 1;
                        echo "<div сlass = 'list'>";
                            $result = mysqli_query($connect, "SELECT front_image, name FROM list_of_products");
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($i % 6 == 0) {
                                    echo"</div><div class = 'list'>";
                                }
                                $frontImage = $row['front_image'];
                                $name = $row['name'];
                                echo "<image src=".$frontImage." name = '".$name."' class = 'image' alt='Изображение товара' data = '".($i-1)."'></image>";
                                $i++;
                            }
                        echo "</div>";
                        echo "<script> var borders = [";
                            $result = mysqli_query($connect, "SELECT border_height, border_width, border_left, border_top FROM list_of_products");
                            while ($row = mysqli_fetch_assoc($result)) {
                                $height = $row['border_height'];
                                $width = $row['border_width'];
                                $left = $row['border_left'];
                                $top = $row['border_top'];
                                echo "[".$left.", ".$top.", ".$width.", ".$height."], ";
                                $i++;
                            }
                        echo "];</script>"
                    ?>
                </div>
                <div class="header_hr">Prints</div>
                <div id= "sd_ft">
                    <?php
                        $i = 1;
                        echo "<div class = 'list'>";
                        $result = mysqli_query($connect, "SELECT image, name FROM list_of_images");
                        while ($row = mysqli_fetch_assoc($result)) {
                                if ($i % 6 == 0) {
                                    echo"</div><div class = 'list'>";
                                }
                                $frontImage = $row['image'];
                                $name = $row['name'];
                                echo "<img src=".$frontImage." class = 'image' name = ".$name." alt='Изображение товара'>";
                                $i++;
                            }
                        echo "</div>";
                    ?>
                </div>
                <div class="header_hr">Inscription</div>
                <ul class = "list">
                    <li><input type = "text" id = "inscription" name = "inscription" placeholder="Enter text to print"></li>
                    <li><input type = "color" id = "btn-color"></li>
                </ul>
                <div class = "invisible" id = "errorlength">The maximum number of characters is 32</div>
                <ul class = "list">
                    <li><button class = "function-button" id = "addtext">Add</button></li>
                </ul>
                <div class="header_hr">Sizes</div>
                <div id="dropdown">
                    <?php
                    echo "<script> var size = [";
                        $result = mysqli_query($connect, "SELECT _2XS, _XS, _S, _M, _L, _XL, _2XL, _3XL, _4XL, _5XL, _6XL FROM list_of_products");
                        while ($row = mysqli_fetch_assoc($result)) {
                            $xxs = $row['_2XS'];
                            $xs = $row['_XS'];
                            $s = $row['_S'];
                            $m = $row['_M'];
                            $l = $row['_L'];
                            $xl = $row['_XL'];
                            $xxl = $row['_2XL'];
                            $xxxl = $row['_3XL'];
                            $xxxxl = $row['_4XL'];
                            $xxxxxl = $row['_5XL']; 
                            $xxxxxxl = $row['_6XL']; 
                            echo "[".$xxs." , ".$xs.", ".$s.", ".$m.", ".$l.", ".$xl.", ".$xxl.", ".$xxxl.", ".$xxxxl.", ".$xxxxxl.", ".$xxxxxxl."],";
                            $i++;
                        }
                        
                    echo "];</script>";
                    ?>
                    <div id = "sbuttons">
                        <ul class="buttons">
                            <li><button class = "button-size" id = "0" name = "2XS">2XS</button></li>
                            <li><button class = "button-size" id = "1" name = "XS">XS</button></li>
                            <li><button class = "button-size" id = "2" name = "S">S</button></li>
                            <li><button class = "button-size" id = "3" name = "M">M</button></li>
                            <li><button class = "button-size" id = "4" name = "L">L</button></li>
                            <li><button class = "button-size" id = "5" name = "XL">XL</button></li>
                        </ul>
                        <ul class="buttons">
                            <li><button class = "button-size" id = "6" name = "2XL">2XL</button></li>
                            <li><button class = "button-size" id = "7" name = "3XL">3XL</button></li>
                            <li><button class = "button-size" id = "8" name = "4XL">4XL</button></li>
                            <li><button class = "button-size" id = "9" name = "5XL">5XL</button></li>
                            <li><button class = "button-size" id = "10" name = "6XL">6XL</button></li>
                        </ul>
                    </div>
                </div>
                <button class = "function-button" id="saveimage">Save</button>
            </div>
        </div>
        <form action = "designer/saver.php" method="post" enctype="multipart/form-data">
        <input class = "invisible" type = "text" name = "product-name" id = "product-name">
        <input class = "invisible" type = "text" name = "print-name" id = "print-name">
        <input class = "invisible" type = "text" name = "size" id = "size">
        <input class = "invisible" type = "number" name = "positionX" id = "positionX">
        <input class = "invisible" type = "number" name = "positionY" id = "positionY">
        <input class = "invisible" type = "number" name = "angle" id = "angle">
        <input class = "invisible" type = "number" name = "width" id = "width">
        <input class = "invisible" type = "number" name = "height" id = "height">
        <input class = "invisible" type = "text" name = "image" id = "urlimage">
        <button type = "submit" class = "invisible" name = "add" id = "add"></button>
        </form>
</body>
<script src="designer/javascrip.js"></script>
</html>