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
                    <a class="nav-menu-item" type="submit" style="cursor: pointer;" onclick="window.location.href='/index.php'">Вітаємо, <?php echo $_SESSION['user']; ?></a>
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

            <div class="menu-button"></div>
        </div>
    </nav>
</header>
<div class="page-wrapper">
    <section class="registration-section">
        <div class="registration-form-wrapper">
            <form style="background-color: #FFFFFF; box-shadow: 0px 0px 7px 3px beige;
                        border-radius: 20px; max-width: 90%; min-width: 80%; height: 700px; text-align: center; top: 10px;" action="role-change.php" method="post">

                        <?php
                        if(isset($_SESSION['role']))
                        {
                            if($_SESSION['role'] == 2) {
                                $db_connect = new mysqli(Clinic_DBSERVER, Clinic_DBUSER, Clinic_DBPASSWORD, Clinic_DATABASE);
                                $sql = 'SELECT *
                                        FROM `users`';

                                $res = mysqli_query($db_connect, $sql);

                                if (mysqli_num_rows($res) > 0) {
                                    echo '<h1 class="form-title" style="text-align: center; font-size: 25px;">Призначити роль користувачу</h1>';
                                    echo '<h1 class="form-label" style="text-align: center; font-size: 20px;"> Користувач </h1><br>';
                                    echo '<select class="form-input form-input-select" style="width: 350px;" name="userEmail" id="userEmail" required>';
                                    $currentUser = $res->fetch_assoc();
                                    echo '<option value="'. $currentUser['user_id'] .'" selected>' . $currentUser['user_id'] . ' - ' . $currentUser['user_email'] . '</option>';
                                    while ($currentUser = $res->fetch_assoc()) {
                                        echo '<option value="'. $currentUser['user_id'] .'">' . $currentUser['user_id'] . ' - ' . $currentUser['user_email'] . '</option>';
                                    }
                                    echo '</select>';
                                    echo '<h1 class="form-label" style="text-align: center; font-size: 20px;"> Роль</h1><br>';
                                    echo '<select class="form-input form-input-select" style="width: 350px;" name="role" id="role" required>
                                    <option value="0" selected>Звичайний користувач</option>
                                    <option value="1">Оператор</option>
                                    <option value="2">Адімінстратор</option>
                                    </select><br>';
                                    echo '<button class="form-submit-button" style="width: 350px;" type="submit">Змінити роль користувача</button>';

                                } else {
                                    echo '<h1 class="form-title" style="text-align: center; font-size: 40px; top: 40%">Користувачів не знайдено</h1>';
                                }
                            }
                            else
                            {
                                echo '<h1 class="form-title" style="text-align: center; font-size: 40px; top: 40%">У вас не достатньо прав на перегляд даної сторінки </h1>';
                            }
                        }
                        else
                        {
                            echo '<h1 class="form-title" style="text-align: center; font-size: 40px; top: 40%">Доступно тільки авторизованим користувачам! </h1>';
                        }
                        ?>

                </form>
            </div>
        </section>
    </div>
    <footer class="footer secondary-text">
        <span class="footer-credentials">
            ©2022 Healthy Life. Всі права захищені.
        </span>
    </footer>
</body>
</html>