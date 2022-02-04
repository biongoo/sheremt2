<?php
    if(!isset($_SESSION['login']))
    {
        $content .= '<form name="login" action="" method="POST">';
            $content .= '<h3>LOGOWANIE</h3>';
            $content .= '<input type="text" name="login" placeholder="Login">';
            $content .= '<input type="password" name="password" placeholder="Hasło">';
            $content .= '<div class="border-wrap">';
                $content .= '<input type="submit" class="button" value="Zaloguj się" name="login_butt">';
            $content .= '</div>';
            $content .= '<a href="forgot">Zapomniałeś hasła? <b>Kliknij tutaj!</b></a>';
        $content .= '</form>';
    }
    else
    {
        $content .= '<form name="logout" action="" method="POST">';
            $content .= '<h4>Witaj, '.$_SESSION['name'].'</h4>';
            $content .= '<a href="" class="panel-links">Stan twoich SM: '.getSM().'</a>';
            //$content .= '<a href="account" class="panel-links">Twoje konto</a>';
            //$content .= '<a href="history" class="panel-links">Historia konta</a>';
            //$content .= '<a href="settings" class="panel-links">Ustawienia konta</a>';
            $content .= '<a href="account" class="panel-links">Panel użytkownika</a>';
            $content .= '<div class="border-wrap">';
                $content .= '<input type="submit" class="button" value="Wyloguj się" name="logout_butt">';
            $content .= '</div>';
        $content .= '</form>';
    }
?>
