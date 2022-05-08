<!DOCTYPE html>
<?php include ('./../../config.php');
include ('./../func/funct.php'); ?>
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
                        <a class="nav-menu-item" type="submit" style="cursor: pointer;" onclick="window.location.href='../auth/auth_form.php'">Авторизація</a>
                    <?php } ?>

                    <div class="dropdown nav-menu-icon">
                        <button onclick="myFunction()" class="drop-btn"></button>
                        <div id="myDropdown" class="dropdown-content">
                            <?php if ($_SESSION['user'] == false) { ?>
                                <a style="cursor: pointer;" onclick="window.location.href='../auth/auth_form.php'">Авторизація</a>
                                <a style="cursor: pointer;" onclick="window.location.href='reg-form.php'">Реєстрація</a>
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

                    $db_connect= new mysqli(Clinic_DBSERVER, Clinic_DBUSER, Clinic_DBPASSWORD, Clinic_DATABASE);

                    if(isset($_GET['status']) and $_GET['status'] == 'ok') {
                        echo '<b class = "form-label" style="top: 40%;">Ви успішно зареєструвалися! Активуйте свій акаунт!</b> <br>';
                        echo '<a href = ' . Clinic_HOST . ' class="form-label" style="top: 60%; "> На головну </a>';
                    }

                    if(isset($_GET['active']) and $_GET['active'] == 'ok') {
                        echo '<b class = "form-label">Ваш аккаунт на сайті ' . Clinic_Workdir . ' успешно активовано!</b><br>';
                        echo '<a href = ' . Clinic_HOST . ' class="form-label" style="top: 60%; "> На головну </a>';
                    }

                    if(isset($_GET['key']))
                    {
                        $sql = 'SELECT *
                            FROM `users`
                            WHERE `active_hex` = "'. $_GET['key'] .'"';
                        $res = mysqlQuery($sql);

                        if(mysqli_num_rows($res) == 0)
                            $err[] = 'Ключ активації нет вірний!';

                        if(is_countable($err) > 0)
                            echo showErrorMessage($err);
                        else
                        {
                            $row = mysqli_fetch_assoc($res);
                            $email = $row['login'];
                            $sql = 'UPDATE `users`
                                    SET `user_status` = 1                          
                                    WHERE `user_email` = "'. $email .'"';
                            $res = mysqli_query($db_connect, $sql);

                            $title = 'Ваш аккаунт на ' . Clinic_Workdir . ' успішно активований';
                            $message = 'Вітаю, ваш акаунт на сайті http://epamproject.com успішно активований';

                            sendMessageMail($email, Clinic_MAIL_AUTOR, $title, $message);

                            header('Location:'. Clinic_HOST .'/?mode=reg&active=ok');
                            exit;
                        }
                    }
                    if(isset($_POST['submit']))
                    {
                        if(empty($_POST['email']))
                            $err[] = 'Поле Email не може бути порожнім!';
                    else
                    {
                        if(!preg_match("/^[a-z0-9_.-]+@([a-z0-9]+\.)+[a-z]{2,6}$/i", $_POST['email']))
                            $err[] = 'Не правильно введений E-mail'."\n";
                        }
                        if(empty($_POST['pass']))
                            $err[] = 'Поле Пароль не может бути порожнім';

                        if(empty($_POST['pass2']))
                            $err[] = 'Поле Підтвердження пароля не може бути порожнім';

                        if(is_countable($err) > 0)
                            echo showErrorMessage($err);
                        else
                        {
                            if($_POST['pass'] != $_POST['pass2'])
                                $err[] = 'Паролі не співпадають';
                                if(is_countable($err) > 0)
                                    echo showErrorMessage($err);
                                else
                                {
                                    $sql = 'SELECT `user_email`
                                        FROM `users`
                                        WHERE `user_email` = "'. $_POST['email'] .'"';
                                    $res = mysqli_query($db_connect, $sql);
                                    if(mysqli_num_rows($res) != 0)
                                        $err[] = 'На жаль email або телефон: <b>'. $_POST['email'] .'</b> зайнятий!';

                                        if(is_countable($err) > 0)
                                            echo showErrorMessage($err);
                                        else
                                        {
                                            $salt = salt();

                                            $pass = md5(md5($_POST['pass']).$salt);

                                            $sql = 'INSERT INTO `users` (`user_name`, `user_passwd`, `user_salt`, `active_hex`, `user_phone`, `user_role`, `user_status`, `user_email`)
                                                VALUES("'. $_POST['name'] .'",
                                                "'. $pass .'",
                                                "'. $salt .'",
                                                "'. md5($salt) .'",
                                                "'. $_POST['phone'] .'",
                                                0,
                                                FALSE,
                                                "'. $_POST['email'] .'"
                                            )';
                                            $res = mysqli_query($db_connect, $sql);
                                            $url = Clinic_HOST .'/?mode=reg&key='. md5($salt);
                                            $title = 'Регистрация на ' . Clinic_Workdir;
                                            $message = 'Для активації акаунту перейдіть за посиланням
                                            <a href="'. $url .'">'. $url .'</a>';

                                            sendMessageMail($_POST['email'], Clinic_MAIL_AUTOR, $title, $message);
                                            header('Location:'. Clinic_HOST .'scripts/reg/reg.php?mode=reg&status=ok');
                                            exit;
                                        }
                                }
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