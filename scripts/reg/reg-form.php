<!DOCTYPE html>
<html lang="en">
<?php include ('./../../config.php');
include ('./../func/funct.php');
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
        <section class="registration-section">
            <div class="registration-form-wrapper">
                <div style="background-color: #FFFFFF; box-shadow: 0px 0px 7px 3px beige;
                border-radius: 20px; max-width: 515px; min-width: 350px; height: 580px;">
                        <h1 class="form-title">Реєстрація користувачів системи</h1> <br>
                        <form action="reg.php" method="POST">
                            <table>
                                <tr>
                                    <td class="form-label"> E-mail<font color="red">*</font>:</td>
                                    <td><input class="form-input" type="text" size="30" name="email" placeholder="Введіть e-mail" required></td>
                                </tr>
                                <tr>
                                    <td class="form-label"> Ваше ім'я <font color="red">*</font>:</td>
                                    <td><input class="form-input" type="text" size="30" name="name" placeholder="Введіть ім'я" required></td>
                                </tr>
                                <tr>
                                    <td class="form-label"> Телефон<font color="red">*</font>:</td>
                                    <td><input class="form-input" type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="+38 (_) __ __ __" required></td>
                                </tr>
                                <tr>
                                    <td class="form-label" > Пароль<font color="red">*</font>:</td>
                                    <td><input class="form-input" type="password" size="30" maxlength="20" name="pass" placeholder="Введіть пароль" required></td>
                                </tr>
                                <tr>
                                    <td class="form-label"> Підтвердження пароля<font color="red">*</font>:</td>
                                    <td><input class="form-input" type="password" size="30" maxlength="20" name="pass2" placeholder="Повторіть пароль" required></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2" style="padding-right: 25%;"><input class="form-submit-button" type="submit" value="Зареєструватися" name="submit"></td>
                                </tr>
                            </table>
                        </form>
                    <br>
                        <h3 style="text-align: center;">Поля зі значком <font color="red">*</font> обов'язкові для заповнення</h3>
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