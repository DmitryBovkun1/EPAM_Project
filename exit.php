<!DOCTYPE html>
<?php include ('./config.php');
include ('./scripts/func/funct.php');
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Clinic</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="shortcut icon" href="/Assets/icon.png" type="image/x-icon">
    <link href="http://fonts.cdnfonts.com/css/roboto" rel="stylesheet">
    <script type="text/javascript" src="https://livejs.com/live.js"></script>
    <script src="./script.js" defer></script>
</head>
<body class = "body-notify">
<div class = "notify-div">
    <div class = "notify-div-block">
        <img class = "success-form-image" src="./Assets/success.png">
        <div class = "notify-div-block-text">
            <?php
            session_unset();
            ?>
            <div class = "success-form-title">Дякуємо за співпрацю</div>
            <div class = "success-form-text">Вихід проведено успішно
                для подальшої роботи необхідно знову авторизуватись</div>
            <button class = "success-form-button" type="submit" onclick="window.location.href='index.php'"><a class="success-form-button-text">Повернутися на головну</a></button>
        </div>
    </div>
</div>
</body>
</html>