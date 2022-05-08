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
                if(isset($_POST['name']) && isset($_POST['phone'])) {
                    date_default_timezone_set('Ukraine/Kiev');
                    $date = date('y-m-d H:i:s');
                    $db_connect = new mysqli(Clinic_DBSERVER, Clinic_DBUSER, Clinic_DBPASSWORD, Clinic_DATABASE);
                    $id = (($_SESSION['id'] ?? null));
                    if($id != null) {
                        $sql = 'INSERT INTO `requests` (`user_name`, `user_custom_id`, `user_phone`, `doctor_profession`, `requests_status`, `request_time`)
                                                    VALUES("' . $_POST['name'] . '",
                                                    "' . $id . '",
                                                    "' . $_POST['phone'] . '",
                                                    "' . $_POST['select'] . '",
                                                    "NEW",
                                                    "' . $date . '"
                                                )';
                        $res = mysqlQuery($db_connect, $sql);
                    }
                    else
                    {
                        $sql = 'INSERT INTO `requests` (`user_name`, `user_phone`, `doctor_profession`, `requests_status`, `request_time`)
                                                    VALUES("' . $_POST['name'] . '",
                                                    "' . $_POST['phone'] . '",
                                                    "' . $_POST['select'] . '",
                                                    "NEW",
                                                    "' . $date . '"
                                                )';
                        $res = mysqlQuery($db_connect, $sql);
                    }
                }?>
                <div class = "success-form-title">Дякуємо за реєстрацію</div>
                <div class = "success-form-text">Наш менеджер з вами зв’яжеться у найближчий 
                час для уточнення всіх деталей</div> 
                <button class = "success-form-button" type="submit" onclick="window.location.href='index.php'"><a class="success-form-button-text">Повернутися на головну</a></button>
            </div>
        </div>
    </div>
</body>
</html>