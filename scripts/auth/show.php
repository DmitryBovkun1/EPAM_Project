
<?php
    if(!defined('Clinic_KEY'))
    {
        header("HTTP/1.1 404 Not Found");
        exit(file_get_contents(Clinic_Workdir . '/404.php'));
    }
    if($user === false)
        echo '<script> alert("Доступ закрыт, Вы не вошли в систему!"); </script>'."\n";

    if($user === true)
        echo '<script> alert("Поздравляю, Вы вошли в систему!"); </script>'."\n";
?>