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
    <div class = "col-md-6">
        <section class="registration-section">
            <div class="registration-form-wrapper">
                <form style="background-color: #FFFFFF; box-shadow: 0px 0px 7px 3px beige;
                            border-radius: 20px; max-width: 90%; min-width: 80%; height: 550px; text-align: center; top: 10px; overflow:hidden; float:left; @media(max-width: 720px) {}" action="" method="get">
                    <h2 class="form-title" style = "padding-bottom:10px;">Пошук заявок електронної черги</h2> <br>
                    <label class="form-label" for="name">Імʼя</label> <br>
                    <input class="form-input" type="text" id="name" name="name" placeholder="Введіть імʼя" value="<?php echo ((isset($_GET['name'])) ? $_GET['name'] : $_SESSION['username']); ?>"> <br>

                    <label class="form-label" for="phone">Телефон</label> <br>
                    <input class="form-input" type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="+38 (_) __ __ __" value="<?php echo ((isset($_GET['phone'])) ? $_GET['phone'] : $_SESSION['phone']); ?>"> <br>

                    <label class="form-label" for="select">Лікар</label> <br>
                    <select class="form-input form-input-select" name="select1" id="select1" required>
                        <option value="dentist">Стоматолог</option>
                        <option value="traumatologist">Травматолог</option>
                        <option value="surgeon">Хірург</option>
                        <option value="oculist">Окуліст</option>
                        <option value="lor">Лор</option>
                        <option value="therapist">Терапевт</option>
                        <option value="" selected>Усі</option>
                    </select> <br>

                    <label class="form-label" for="select">Статус заявки</label> <br>
                    <select class="form-input form-input-select" name="select2" id="select2" required>
                        <option value="NEW">NEW</option>
                        <option value="INPROGRESS">INPROGRESS</option>
                        <option value="CLOSED">CLOSED</option>
                        <option value="" selected>DEFAULT</option>
                    </select><br>
                    <button class="form-submit-button" type="submit">Пошук</button>
                </form>

            </div>
        </section>
    </div>
    <div class = "col-md-6" style="background-color: #FFFFFF; box-shadow: 0px 0px 7px 3px beige;
            border-radius: 20px; max-width: 90%; min-width: 80%; height: 700px; text-align: center; top: 10px; float:right; @media(max-width: 720px) {}">
        <?php
            if(isset($_GET['select1']) || isset($_GET['select2']) || isset($_GET['name']) || isset($_GET['phone']))
            {
                $db_connect = new mysqli(Clinic_DBSERVER, Clinic_DBUSER, Clinic_DBPASSWORD, Clinic_DATABASE);
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $page--;
                $count = 6;

                $sql = "SELECT * FROM `requests` where `user_name` like '%" . $_GET['name'] . "%' and `user_phone` like '%" . $_GET['phone'] . "%' 
                and `doctor_profession` like '%" . $_GET['select1'] . "%' and `requests_status` like '%" . $_GET['select2'] . "%' order by `request_time` limit " . $count*$page . ", " . $count;
                $sqlR = "SELECT * FROM `requests` where `user_name` like '%" . $_GET['name'] . "%' and `user_phone` like '%" . $_GET['phone'] . "%' 
                and `doctor_profession` like '%" . $_GET['select1'] . "%' and `requests_status` like '%" . $_GET['select2'] . "%' order by `request_time`";

                $res = mysqli_query($db_connect, $sql);
                $resSize = mysqli_query($db_connect, $sqlR);
                $sqlRowNum = ceil(mysqli_num_rows($resSize)/$count);
                if (mysqli_num_rows($res) > 0)
                {
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
                    echo "</table>\n";
                    $url = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '') . '://';
                    $url = $url . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                    if($page != 0)
                    {
                        $href = Clinic_HOST . "history.php?name=" . str_replace(" ", "+",$_GET['name']) . "&phone=" . $_GET['phone'] . "&select1=" . $_GET['select1'] . "&select2=" . $_GET['select2'] . "&page=" . $page;
                        echo "<a href=" . $href . "> < </a><a>     |     </a>";
                    }
                    for ($i = 1; $i <= $sqlRowNum; $i++) {
                        $href = Clinic_HOST . "history.php?name=" . str_replace(" ", "+",$_GET['name']) . "&phone=" . $_GET['phone'] . "&select1=" . $_GET['select1'] . "&select2=" . $_GET['select2'] . "&page=" . $i;
                        if($page == 0 && $i == 1)
                        {
                            echo "<a> " . $i . " </a>";
                        }
                        else {
                            if ($href != $url) {
                                if($i == 1)
                                    echo "<a href=" . $href . "> " . $i . "</a><a>...</a>";
                                if($i == ($sqlRowNum))
                                    echo "<a>...</a><a href=" . $href . "> " . $i . " </a>";
                            } else {
                                echo "<a> " . $i . " </a>";
                            }
                        }
                    }
                    if($page != ($sqlRowNum -1))
                    {
                        $nextPage = $page + 2;
                        $href = Clinic_HOST . "history.php?name=" . str_replace(" ", "+",$_GET['name']) . "&phone=" . $_GET['phone'] . "&select1=" . $_GET['select1'] . "&select2=" . $_GET['select2'] . "&page=" . $nextPage;
                        echo "<a>     |     </a><a href=" . $href . ">   > </a>";
                    }
                    if($_SESSION['role'] == 1 || $_SESSION['role'] == 2)
                    {
                        $hrefCheck = Clinic_HOST . "requestStatus.php?name=" . str_replace(" ", "+",$_GET['name']) . "&phone=" . $_GET['phone'] . "&select1=" . $_GET['select1'] . "&select2=" . $_GET['select2'] . "&page=" . ($page + 1);
                        echo '<button class = "success-form-button" style=\'alignment: center; text-align: center; margin:0 auto; top: 30%\' type="submit" onclick="window.location.href=\''. $hrefCheck . '\'"><a style="text-align: center;" class="success-form-button-text">Обробити дані заявки</a></button>';
                    }
                }
                else
                {
                    echo '<h2 class="form-title" style = "top:40%; text-align: center; ">Заявки за даними критеріями пошуку не знайдені</h2> <br>';
                }
            }
            else
            {
                echo '<h2 class="form-title" style = "top:40%; text-align: center; ">Спочатку введіть параметри пошуку</h2> <br>';
            }
        ?>
    </div>
</div>
<footer class="footer secondary-text">
        <span class="footer-credentials">
            ©2022 Healthy Life. Всі права захищені.
        </span>
</footer>
</body>
</html>