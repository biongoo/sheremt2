<?php
    use PHPMailer\PHPMailer\PHPMailer;
    $title = "Zmień e-mail - ";
    $data = "chg_email";
    require_once './include/header.php';

    if(isset($_POST['chg_butt']))
    {
        //captchaCheck();
        alert("Funkcja niedostępna.");
        /*$email = $_SESSION['email'];
        $new_email = $_POST['new_email'];

        if($new_email != $_POST['repeat_new_email'])
            alert('Podane maile nie są takie same!');

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            alert('Nieprawidłowy adres email!');

        newRandom();
        $stmt = $sql->prepare('SELECT COUNT(*) FROM `site`.`chg_email` WHERE `old_email`=?');
        $stmt->execute([$email]);
        $result = $stmt->fetchColumn();
        if(!$result)
            $sql->prepare('INSERT INTO `site`.`chg_email` (`id_account`, `old_email`, `new_email`, `rand1`) VALUES (?,?,?,?)')->execute([$_SESSION['id'], $email, $new_email, $random]);
        else
            $sql->prepare('UPDATE `site`.`chg_email` SET `new_email`=?, `rand1`=? WHERE `id_account`=? AND `old_email`=?')->execute([$new_email, $random, $_SESSION['id'], $email]);

        $mail = new PHPMailer(TRUE);

        $message = '<html><head></head><body>';
        $message .= '<center><b>Witaj Graczu!</b><br>Aby zmienić email do Twojego konta na email "'.$new_email.'" kliknij w <b><a href="'.$name.'chg_email/'.$random.'">ten link</a></b>!';
        $message .= '<br>Jeżeli to nie Ty dokonałeś zmiany email na ShereMT2.pl - zmień natychmiast swoje hasło!<br><br>ShereMT2.pl &copy; Wszelkie prawa zastrzeżone</center>';
        $message .= '</body></html>';

        try {
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('admin@sheremt2.pl', 'ShereMT2');
            $mail->addAddress($email);
            $mail->Subject = 'ShereMT2.pl - Zmiana adresu email';
            $mail->isHTML(TRUE);
            $mail->Body = $message;
            $mail->send();  
        }
        catch (Exception $e)
        {
            alert($e->errorMessage());
        }
        catch (\Exception $e)
        {
            alert($e->getMessage());
        }*/
    }

    is_login(true);

    $content .= '<a class="back-btn" href="../settings"><i class="fas fa-arrow-alt-circle-left"></i> Powrót</a>';
    $content .= '<div class="content">';
        $content .= '<div class="header-bg">';
            $content .= '<h1>Zmień e-mail</h1>';
        $content .= '</div>';
        $content .= '<form name="step1" class="step1" method="POST">';
            $content .= '<label for="new_email">Podaj nowy e-mail:</label>';
            $content .= '<input type="email" name="new_email" id="new_email" required>';
            $content .= '<label for="repeat_new_email">Powtórz nowy e-mail:</label>';
            $content .= '<input type="email" name="repeat_new_email" id="repeat_new_email" required>';
            //$content .= '<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LdHi4UUAAAAABGkctzW3bzSGrMGGP_bOtSTKVzB"></div>';
            $content .= '<div class="border-wrap">';
                $content .= '<input type="submit" class="button" name="chg_butt" value="Zmień e-mail">';
            $content .= '</div>';
        $content .= '</form>';
    $content .= '</div>';

    require_once './include/footer.php';
?>
