<!DOCTYPE html>
<html lang="en">
<?php
header('Content-Type: text/html; charset=UTF8');
include ('./config.php');
include ('./scripts/func/funct.php');
session_start();
?>
<head>
    <meta charset="UTF-8">
    <title>My Clinic</title>
    <link rel="shortcut icon" href="/Assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="/style/style.css">
    <link href="http://fonts.cdnfonts.com/css/roboto" rel="stylesheet">
    <script type="text/javascript" src="https://livejs.com/live.js"></script>
    <script src="/script.js" defer></script>
</head>

<body>
<header class="header">
    <nav class="nav-bar secondary-text">
        <div class="nav-bar-wrapper">
            <div class="nav-logo-wrapper">
                <a class="nav-logo" type="submit" style="cursor: pointer;" onclick="window.location.href='/index.php'"></a>
                <a class="nav-title" type="submit" style="cursor: pointer;" onclick="window.location.href='/index.php'">Healthy Life</a>
            </div>

            <div class="nav-menu-wrapper">
                <a class="nav-menu-item" type="submit" style="cursor: pointer;" onclick="window.location.href='/index.php'">Головна</a>
                <a class="nav-menu-item" type="submit" style="cursor: pointer;" onclick="window.location.href='/history.php'">Пошук заявок</a>
                <?php if ($_SESSION['role'] == 2 && $_SESSION['user'] == true){?>
                    <a class="nav-menu-item" type="submit" style="cursor: pointer;" onclick="window.location.href='/panel.php'">Змінити роль користувача</a>
                <?php } elseif ($_SESSION['role'] == 1 && $_SESSION['user'] == true) {?>
                    <a class="nav-menu-item" type="submit" style="cursor: pointer;" onclick="window.location.href='/history.php'">Обрати заявки на обробку</a>
                <?php } elseif ($_SESSION['role'] == 0 && $_SESSION['user'] == true){?>
                    <a class="nav-menu-item" type="submit" style="cursor: pointer;" onclick="window.location.href='/index.php'">Вітаємо, <?php echo $_SESSION['username']; ?></a>
                <?php } else {?>
                    <a class="nav-menu-item" type="submit" style="cursor: pointer;" onclick="window.location.href='scripts/auth/auth_form.php'">Авторизація</a>
                <?php } ?>

                <div class="dropdown nav-menu-icon">
                    <button onclick="myFunction()" class="drop-btn"></button>
                    <div id="myDropdown" class="dropdown-content">
                        <?php if ($_SESSION['user'] == false) { ?>
                            <a style="cursor: pointer;" onclick="window.location.href='scripts/auth/auth_form.php'">Авторизація</a>
                            <a style="cursor: pointer;" onclick="window.location.href='scripts/reg/reg-form.php'">Реєстрація</a>
                        <?php } else { ?>
                            <a style="cursor: pointer;" onclick="window.location.href='/exit.php'">Вийти</a>
                        <?php }?>
                    </div>
                </div>

            </div>
            <button class="open-btn" onclick="openNav()">&#9776;</button>
        </div>
    </nav>
</header>
<div class="nav-bar-mobile" id="mySidepanel">
    <a href="javascript:void(0)" class="close-btn" onclick="closeNav()">&times;</a>
    <a href="<?php echo Clinic_Workdir?>">Головна</a>
    <a href="<?php echo Clinic_Workdir?>/history.php">Пошук заявок</a>
    <?php if ($_SESSION['role'] == 2 && $_SESSION['user'] == true){?>
        <a href="<?php echo Clinic_Workdir?>/panel.php">Змінити роль користувача</a>
    <?php } ?>
    <?php if ($_SESSION['role'] == 1 && $_SESSION['user'] == true) {?>
        <a href="<?php echo Clinic_Workdir?>/history.php">Обрати заявки на обробку</a>
    <?php } ?>
    <?php if ($_SESSION['user'] == false) { ?>
        <a href="<?php echo Clinic_Workdir?>/scripts/auth/auth_form.php">Авторизуватися</a>
        <a href="<?php echo Clinic_Workdir?>/scripts/reg/reg-form.php">Реєстрація</a>
    <?php } else { ?>
        <a href="<?php echo Clinic_Workdir?>/exit.php">Вийти</a>
    <?php } ?>
</div>
<div class="page-wrapper">
    <div style="background-color: #FFFFFF; box-shadow: 0px 0px 7px 3px beige;
            border-radius: 20px; max-width: 90%; min-width: 80%; height: 700px; text-align: center; top: 10px;">
        <?php
        if ($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
            if (isset($_GET['select1']) && isset($_GET['select2']) && isset($_GET['name']) && isset($_GET['phone']) && isset($_GET['page'])) {
                $count = 6;
                $page = $_GET['page']; $page--;
                $sql = "SELECT * FROM (SELECT * FROM `requests` where `user_name` like '%" . $_GET['name'] . "%' and `user_phone` like '%" . $_GET['phone'] . "%' 
                and `doctor_profession` like '%" . $_GET['select1'] . "%' and `requests_status` like '%" . $_GET['select2'] . "%'
                 order by `request_time` limit " . $count*$page . ", " . $count . ") A where A.`requests_status`<>'CLOSED'";
                $db_connect = new mysqli(Clinic_DBSERVER, Clinic_DBUSER, Clinic_DBPASSWORD, Clinic_DATABASE);
                $res = mysqli_query($db_connect, $sql);
                if (mysqli_num_rows($res) > 0) {
                    echo "<h3 class=\"form-title\" style='text-align: center;'>Список заявок</h3>";
                    echo "<table class=\"table-custom\" valign=\"top\" style='alignment: center; text-align: center; margin:0 auto;'>\n";
                    echo "<tr>";
                    echo "<td class = \"td\">" . "ID заявки" . "</td>";
                    echo "<td class = \"td\">" . "Ім'я користувача" . "</td>";
                    echo "<td class = \"td\">" . "Телефон користувача" . "</td>";
                    echo "<td class = \"td\">" . "Спецальність лікаря" . "</td>";
                    echo "<td class = \"td\">" . "Статус заявки" . "</td>";
                    echo "<td class = \"td\">" . "Час відправки заявки" . "</td>";
                    echo "</tr>";
                    while ($req = $res->fetch_assoc()) {
                        $sqlUpdateFirst = "UPDATE `requests` set `requests_status`= \"INPROGRESS\" where `requests_id` = " . $req['requests_id'];
                        $r = mysqli_query($db_connect, $sqlUpdateFirst);
                        $pro = $req['doctor_profession'];
                        switch($req['doctor_profession'])
                        {
                            case 'dentist':
                                $pro = 'Стоматолог';
                                break;
                            case 'traumatologist':
                                $pro = 'Травматолог';
                                break;
                            case 'surgeon':
                                $pro = 'Хірург';
                                break;
                            case 'oculist':
                                $pro = 'Окуліст';
                                break;
                            case 'lor':
                                $pro = 'Лор';
                                break;
                            case 'therapist':
                                $pro = 'Терапевт';
                                break;
                        }
                        echo "<tr>";
                        echo "<td class = \"td\">" . $req['requests_id'] . "</td>";
                        echo "<td class = \"td\">" . $req['user_name'] . "</td>";
                        echo "<td class = \"td\">" . $req['user_phone'] . "</td>";
                        echo "<td class = \"td\">" . $pro . "</td>";
                        echo "<td class = \"td\">" . $req['requests_status'] . "</td>";
                        echo "<td class = \"td\">" . $req['request_time'] . "</td>";
                        echo "</tr>";
                    }
                    $hrefCheck = Clinic_HOST . "closedStatus.php?name=" . str_replace(" ", "+",$_GET['name']) . "&phone=" . $_GET['phone'] . "&select1=" . $_GET['select1'] . "&select2=" . $_GET['select2'] . "&page=" . ($page + 1);
                    echo '<button class = "success-form-button" style=\'alignment: center; text-align: center; margin:0 auto; top: 30%\' type="submit" onclick="window.location.href=\''. $hrefCheck . '\'"><a style="text-align: center;" class="success-form-button-text">Закрити дані заявки</a></button>';
                }
                else
                {
                    echo '<div style=\'alignment: center; text-align: center; margin:0 auto; top: 40%\'><h2 class="form-title" style = "top:40%; text-align: center; ">За заданими критеріями заявки не знайдені, або вони вже закриті</h2> <br>';
                    echo '<button class = "success-form-button" style=\'alignment: center; text-align: center; margin:0 auto; top: 30%\' type="submit" onclick="window.location.href=\'history.php\'"><a style="text-align: center;" class="success-form-button-text">Перейти до вибору заявок</a></button></div>';
                }
            }
            else {
                echo '<div style=\'alignment: center; text-align: center; margin:0 auto; top: 40%\'><h2 class="form-title" style = "top:40%; text-align: center; ">Спочатку введіть параметри на сторінці</h2> <br>';
                echo '<button class = "success-form-button" style=\'alignment: center; text-align: center; margin:0 auto; top: 30%\' type="submit" onclick="window.location.href=\'history.php\'"><a style="text-align: center;" class="success-form-button-text">Перейти до вибору заявок</a></button></div>';
            }
        }
        else
        {
            echo '<div style=\'alignment: center; text-align: center; margin:0 auto; top: 40%\'><h2 class="form-title" style = "top:40%; text-align: center; ">У вас немає доступу до даного ресурсу. Будь-ласка авторизуйтеся, або зверніться до адміністратора</h2> <br>';
            echo '<button class = "success-form-button" style=\'alignment: center; text-align: center; margin:0 auto; top: 30%\' type="submit" onclick="window.location.href=\'index.php\'"><a style="text-align: center;" class="success-form-button-text">Перейти на головну</a></button></div>';
        }
        ?>
    </div>
    <footer class="footer secondary-text">
        <span class="footer-credentials">
            ©2022 Healthy Life. Всі права захищені.
        </span>
    </footer>
</body>
</html>