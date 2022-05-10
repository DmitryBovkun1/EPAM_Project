<!DOCTYPE html>
<html lang="en">
<?php
    header('Content-Type: text/html; charset=UTF8');
    include ('./config.php');
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
                <div class="registration-form-image-wrapper">
                    <img class="registration-form-image" id="doctor-img" src="./Assets/therapist.png" alt="doctor-img">
                </div>

                <div class="form-card flex-column">
                    <div class="form-wrapper">

                        <h2 class="form-title">Електронна черга
                        для запису до лікаря</h2>

                        <form class="registration-form flex-column" action="success.php" method="post">

                            <label class="form-label" for="name">Імʼя</label>
                            <input class="form-input" type="text" id="name" name="name" placeholder="Введіть імʼя" value="<?php echo $_SESSION['username']; ?>" required>

                            <label class="form-label" for="phone">Телефон</label>
                            <input class="form-input" type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="+38 (_) __ __ __" value="<?php echo $_SESSION['phone']; ?>" required>

                            <label class="form-label" for="select">Лікар</label>
                            <select class="form-input form-input-select" name="select" id="select" required>
                                <option value="dentist">Стоматолог</option>
                                <option value="traumatologist">Травматолог</option>
                                <option value="surgeon">Хірург</option>
                                <option value="oculist">Окуліст</option>
                                <option value="lor">Лор</option>
                                <option value="therapist" selected>Терапевт</option>
                            </select>
                            <button class="form-submit-button" type="submit">Зареєструватися</button>
                        </form>
                    </div>
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