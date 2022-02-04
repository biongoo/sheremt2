<?php
    ob_start();
    $title = "Zmień hasło - ";
    $data = "chg_pswd";
    require_once './include/header.php';

    is_login(true);

    if(isset($_POST['chg_butt']))
        {
            //captchaCheck(); // CAPTCHA
            $old_paswd = $_POST['old_paswd']; $password = $_POST['new_paswd']; $password_repeat = $_POST['repeat_new_paswd']; // Przypisanie zmiennych

            $stmt = $sql->prepare('SELECT COUNT(*) FROM `account` WHERE `id` = ? AND `password` = PASSWORD(?)'); // Sprawdzanie starego hasła
            $stmt->execute([$_SESSION['id'], $old_paswd]);
            $result = $stmt->fetchColumn();
            if(!$result)
                alert('Podane stare hasło nie jest prawidłowe!');

            if($password != $password_repeat)
                alert('Podane hasła nie są takie same!');

            if($password == $old_paswd)
                alert('Podane hasła są takie same!');

            if(strlen($password) < 4 || strlen($password) > 16)
                alert('Hasło musi posiadać od 4 do 16 znaków!');

            $sql->prepare('UPDATE `account` SET `password` = PASSWORD(?) WHERE `id` = ?')->execute([$password, $_SESSION['id']]);
            logout('Hasło zmieniono pomyślnie! Zaloguj się ponownie!');
        }

    $content .= '<a class="back-btn" href="../settings"><i class="fas fa-arrow-alt-circle-left"></i> Powrót</a>';
    $content .= '<div class="content">';
        $content .= '<div class="header-bg">';
            $content .= '<h1>Zmień hasło</h1>';
        $content .= '</div>';
        $content .= '<form class="step1" method="POST">';
            $content .= '<label for="old_paswd">Podaj swoje aktualne hasło:</label>';
            $content .= '<input type="password" name="old_paswd" required>';
            $content .= '<label for="new_paswd">Podaj nowe hasło:</label>';
            $content .= '<input type="password" name="new_paswd" required>';
            $content .= '<label for="repeat_new_paswd">Powtórz nowe hasło:</label>';
            $content .= '<input type="password" name="repeat_new_paswd" required>';
            //$content .= '<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LdHi4UUAAAAABGkctzW3bzSGrMGGP_bOtSTKVzB"></div>';
            $content .= '<div class="border-wrap">';
                $content .= '<input type="submit" class="button" name="chg_butt" value="Zmień hasło">';
            $content .= '</div>';
        $content .= '</form>';
    $content .= '</div>';
	
    require_once './include/footer.php';
?>
