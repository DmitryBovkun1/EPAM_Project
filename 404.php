<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Помилка 404</title>
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
                <table style="background-color: #FFFFFF; box-shadow: 0px 0px 7px 3px beige;
                border-radius: 20px;" width="700" cellpadding="4" cellspacing="1" border="0" align="center">
                    <tr>
                        <td>
                            <h1 style="text-align: center;" class="form-title">Помилка 404</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h2 style="text-align: center;">
                                Сторінка не знайдена - 404!!
                            </h2> <br>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <span class="leftMenu"><a href="javascript:history.back(-1)">Повернутися</a></span>
                        </td>
                    </tr>
                </table>
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