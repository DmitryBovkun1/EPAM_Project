<!DOCTYPE html>
<?php include ('./../../config.php');
include ('./../func/funct.php');
session_start();
?>
<html lang="en">
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
                        <a class="nav-menu-item" type="submit" style="cursor: pointer;" onclick="window.location.href='auth_form.php'">Авторизація</a>
                    <?php } ?>

                    <div class="dropdown nav-menu-icon">
                        <button onclick="myFunction()" class="drop-btn"></button>
                        <div id="myDropdown" class="dropdown-content">
                            <?php if ($_SESSION['user'] == false) { ?>
                                <a style="cursor: pointer;" onclick="window.location.href='auth_form.php'">Авторизація</a>
                                <a style="cursor: pointer;" onclick="window.location.href='../reg/reg-form.php'">Реєстрація</a>
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
                <div style="background-color: #FFFFFF; box-shadow: 0px 0px 7px 3px beige;
                        border-radius: 20px; max-width: 315px; min-width: 250px; height: 280px; text-align: center;">
                <?php
                    if(isset($_GET['mode']) == 'auth')
                    {
                        echo '<h3 class="form-title" style="text-align: center; right: 20px;">Вхід успішно виконано!<h3>';
                        echo '<a href = ' . Clinic_HOST . ' class="form-label"> На головну </a>';
                    }
                    if(isset($_POST['submit']))
                    {
                        if(empty($_POST['email']))
                            $err[] = 'Не ведено Логін';

                        if(empty($_POST['pass']))
                            $err[] = 'Не ведено Пароль';

                        if(is_countable($err) > 0)
                            echo showErrorMessage($err);
                        else
                        {
                            $db_connect= new mysqli(Clinic_DBSERVER, Clinic_DBUSER, Clinic_DBPASSWORD, Clinic_DATABASE);
                            $sql = 'SELECT *
                                FROM `users`
                                WHERE `user_email` = "'. $_POST['email'] .'"';
                                //AND `user_status` = 1';
                            $res = mysqli_query($db_connect, $sql);

                            if(mysqli_num_rows($res) > 0)
                            {
                                $row = mysqli_fetch_assoc($res);

                                if(md5(md5($_POST['pass']).$row['user_salt']) == $row['user_passwd'])
                                {
                                    $_SESSION['user'] = true;
                                    $_SESSION['hex'] = $row['active_hex'];
                                    $_SESSION['phone'] = $row['user_phone'];
                                    $_SESSION['username'] = $row['user_name'];
                                    $_SESSION['email'] = $row['user_email'];
                                    $_SESSION['id'] = $row['user_id'];
                                    $_SESSION['role'] = $row['user_role'];
                                    header('Location:'. Clinic_HOST .'/scripts/auth/auth.php?mode=auth');
                                    exit;
                                }
                                else
                                    echo showErrorMessage('Не вірний пароль!');
                            }
                            else
                                echo showErrorMessage('Логін <b>'. $_POST['email'] .'</b> не знайдений!');
                        }
                }
                ?>
                </div>
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