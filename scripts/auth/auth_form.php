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
                border-radius: 20px; max-width: 500px; min-width: 250px; height: 330px;">
                <h2 class="form-title" style="padding-left: 20%;" >Авторизація</h2> <br>
                <form action="auth.php" method="POST">
                    <table>
                        <tr class="form-label">
                            <td class="form-label">E-mail:</td>
                            <td><input class="form-input" type="text" size="30" name="email" placeholder="Введіть e-mail" required></td>
                        </tr>
                        <tr class="form-label">
                            <td class="form-label">Пароль:</td>
                            <td><input class="form-input" type="password" size="30" maxlength="20" name="pass" placeholder="Введіть пароль" required></td>
                        </tr>
                        <tr class="form-label" style="align-items: center;">
                            <td class="form-label">&nbsp;</td>
                            <td colspan="2"><input class="form-submit-button" type="submit" value="Увійти" name="submit"></td>
                        </tr>
                    </table>
                </form>
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