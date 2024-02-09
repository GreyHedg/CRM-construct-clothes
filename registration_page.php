    <?php
    session_start();
    if ($_SESSION['user']) {
        header('Location: profile_page.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset ="UTF-8">
    <title>Registration page</title>
    <link rel ="icon" href="..logo.ico" />
    <link rel ="stylesheet" href="registration_page.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital@1&display=swap" rel="stylesheet">
</head>
<body>
    <div class = "header">
        <div class = "conteiner">
            <div class = "title">
                <div class = "title-logo">
                    <image src = "..logo.png" class = "logo"></image>
                </div>
                <div class = "title-name">
                    Print.bmstu
                </div>
            </div>
            <div class = "navigation">
                <ul class = "navigation-content">
                    <li><a href = "registration_page.php" class = "registration">Registration</a></li>
                    <li><a href = "login_page.php" class = "login">Log in</a></li>
                    <li><button class = "day-and-night" onClick="nightMode"><image src = "..day-and-night.png" class = "day-night"></image></button></li>
                </ul>
            </div>
        </div>
    </div>
    <div class = "registration-menu">
        <ul class = "autorization"> 
            <li><form action = "registration.php" method="post" class = "autorization-element-label">Login</label><input id = "login" class = "autorization-element-input" type = "text" name = "login"></li>
            <li><form action = "registration.php" method="post" class = "autorization-element-label">Role</label><input class = "autorization-element-input" type = "text" name = "role"></li>
            <li><form action = "registration.php" method="post" class = "autorization-element-label">Password</label><input id = "password" class = "autorization-element-input" type = "text" name = "password"></li>
            <li><form action = "registration.php" method="post" class = "autorization-element-label">Confirm password</label><input id = "password-confirm" class = "autorization-element-input" type = "text" name = "password-confirm"></li>
            <li><button type = "submit" class = "login-button">Register</button></li>
            <li id = "error-registration-pass" class = "error-registration">  
                <?php
                if ($_SESSION['message']) {
                    echo '<p> ' . $_SESSION['message'] . ' </p>';
                }
                unset($_SESSION['message']);
                ?>
            </li>
        </ul>
        
    </div>
    <script src="index.js"></script>
</body>