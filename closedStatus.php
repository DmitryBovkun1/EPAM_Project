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
            <?php
            if (isset($_GET['select1']) && isset($_GET['select2']) && isset($_GET['name']) && isset($_GET['phone']) && isset($_GET['page'])) {
                $count = 6;
                $page = $_GET['page']; $page--;
                $sql = "SELECT * FROM (SELECT * FROM `requests` where `user_name` like '%" . $_GET['name'] . "%' and `user_phone` like '%" . $_GET['phone'] . "%' 
                    and `doctor_profession` like '%" . $_GET['select1'] . "%' and `requests_status` like '%" . $_GET['select2'] . "%'
                     order by `request_time` limit " . $count*$page . ", " . $count . ") A where A.`requests_status`<>'CLOSED'";
                $db_connect = new mysqli(Clinic_DBSERVER, Clinic_DBUSER, Clinic_DBPASSWORD, Clinic_DATABASE);
                $res = mysqli_query($db_connect, $sql);
                if (mysqli_num_rows($res) > 0) {
                    while ($req = $res->fetch_assoc()) {
                        $sqlUpdateSecond = "UPDATE `requests` set `requests_status`= \"CLOSED\", employee_id = '" . $_SESSION['id'] . "' where `requests_id` = " . $req['requests_id'];
                        $r = mysqli_query($db_connect, $sqlUpdateSecond);
                    }
                ?>
                    <img class = "success-form-image" src="./Assets/ok.jpg">
                    <div class = "notify-div-block-text">
                    <div class = "success-form-title">Заявки закриті</div>
                    <div class = "success-form-text">Вказані вами заяви успішно закриті</div>
                <?php }
                else
                {?>
                        <img class = "success-form-image" src="./Assets/fail.png">
                        <div class = "notify-div-block-text">
                            <div class = "success-form-title">Заявки не закриті</div>
                            <div class = "success-form-text">Вказані вами заяви не закриті, оскільки відкритих заяв за заданими критеріями не виявлено</div>
                            <?php
                }
            }
            else
            {?>
                            <img class = "success-form-image" src="./Assets/fail.png">
                            <div class = "notify-div-block-text">
                            <div class = "success-form-title">Заявки не закриті</div>
                            <div class = "success-form-text">Вказані вами заяви не закриті, оскільки один з критеріїв не заданий</div>
            <?php
            }
            ?>

            <button class = "success-form-button" type="submit" onclick="window.location.href='index.php'"><a class="success-form-button-text">Повернутися на головну</a></button>
        </div>
    </div>
</div>
</body>
</html>