<?php
    //Time-out
    if(isset($_SESSION['login']) && $now > $_SESSION['discard_after'])
        logout('Zostałeś wylogowany z powodu nieaktywności!');
    $_SESSION['discard_after'] = $now + $logout_after;

    //Check passwd
    if(isset($_SESSION['login']))
    {
        $stmt = $sql->prepare('SELECT `login` FROM `account` WHERE `login`=? AND `password`=PASSWORD(?) AND `email`=? AND `status`="OK" AND `availDt`<NOW()');
        $stmt->execute([$_SESSION['login'], $_SESSION['password'], $_SESSION['email']]);
        $login = $stmt->fetchColumn();
        if(!$login)
            logout('Zaloguj się ponownie!');
    }

    //Login
    if(isset($_POST['login_butt']))
        login($_POST['login'], $_POST['password']);

    //Logout
    if(isset($_POST['logout_butt']))
        logout('Wylogowano pomyślnie!');
?>