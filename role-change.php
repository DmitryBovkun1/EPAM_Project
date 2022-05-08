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
            <img class = "success-form-image" src="./Assets/increase-decrease.jpg">
            <div class = "notify-div-block-text">
                <?php
                if (isset($_SESSION['role']))
                {
                    if($_SESSION['role'] == 2)
                    {
                        $db_connect= new mysqli(Clinic_DBSERVER, Clinic_DBUSER, Clinic_DBPASSWORD, Clinic_DATABASE);
                        if(isset($_POST['userEmail']) && isset($_POST['role'])) {
                            $sql = 'UPDATE `users`
                                            SET `user_role` = "'. $_POST['role'] .'"WHERE `user_id` = "'. $_POST['userEmail'] .'"';
                            $res = mysqli_query($db_connect, $sql);
                        }?>
                        <div class = "success-form-title">Роль змінена</div>
                        <div class = "success-form-text">Для застосування змін користувач
                        має закінчити всі сесії</div>
                        <?php } else {?>
                            <div class = "success-form-title">Роль не змінена</div>
                            <div class = "success-form-text">У вас не достатньо прав для
                                здійснення даної дії</div>
                        <?php
                    }
                }
                else
                {
                    echo '<div class = "success-form-title">Роль не змінена</div>';
                    echo '<div class = "success-form-text"> Доступно тільки авторизованим користувачам!</div>';
                }
                ?>
                <button class = "success-form-button" type="submit" onclick="window.location.href='index.php'"><a class="success-form-button-text">Повернутися на головну</a></button>
            </div>
        </div>
    </div>
</body>
</html>