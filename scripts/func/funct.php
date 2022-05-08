<?php

    function escape_str($data)
    {
        if(is_array($data))
        {
            if(get_magic_quotes_gpc())
                $strip_data=array_map("stripslashes",$data);
                $result=array_map("mysql_real_escape_string",$strip_data);
                return $result;
        }
        else
        {
            if(get_magic_quotes_gpc())
                $data=stripslashes($data);
                $result=mysqli_real_escape_string($data);
                return $result;
        }
    }


    function sendMessageMail($to,$from,$title,$message){

        $subject=$title;
        $subject='=?utf-8?b?'.base64_encode($subject).'?=';

        $headers="Content-type:text/html;charset=\"utf-8\"\r\n";
        $headers.="From:".$from."\r\n";
        $headers.="MIME-Version:1.0\r\n";
        $headers.="Date:".date('D, d M Y h:i:s O')."\r\n";

        if(!mail($to, $subject, $message, $headers))
            return 'Ошибка отправки письма!';
        else
            return true;
    }

    function showErrorMessage($data)
    {
        $err='<ul style = "text-align: center;">'."\n";

        if(is_array($data))
        {
            foreach($data as $val)
            $err.='<li class = "form-label" style="color:red;">'.$val.'</li>'."\n";
        }
        else
            $err.='<li class = "form-label" style="color:red;">'.$data.'</li>'."\n";

            $err.='</ul>'."\n";
        $err .= '<h1 class="form-title" style="color:red; text-align: center; right: 25px;">ERROR</h1>';
        $err .= '<a href = ' . Clinic_HOST . ' class="form-label" style="top: 10%; "> На головну </a>';

        return $err;
    }


    function mysqlQuery($db_connect, $sql)
    {
        $res=mysqli_query($db_connect, $sql);
        if(!$res)
        {
            $message='Неверный запрос: '.mysqli_error($db_connect)."\n";
            die($message);
        }

        return $res;
    }

    function salt()
    {
        $salt=substr(md5(uniqid()), -10);
        return $salt;
    }
?>