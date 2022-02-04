<?php
    ob_start();
    $title = "Przypomnij hasło - ";
    $data = "forgot";
    require_once './include/header.php';

    is_login(false);
    
    $step = 1;

    if(isset($_POST['login']))
    {
        //captchaCheck();
        $login = $_POST['login'];
        if(strlen($login) < 4 || strlen($login) > 30)
		{
            alert('Login jest nieprawidłowy!');
        }

        newRandom();
        $stmt = $sql->prepare('SELECT `email` FROM `account` WHERE `login`=?');
        $stmt->execute([$login]);
        $email = $stmt->fetchColumn();

        if($email)
        {
            $stmt = $sql->prepare('UPDATE `account` SET `random_forgot`=? WHERE `login`=?');
            $stmt->execute([$random, $login]);
            forgotMail($email, $random);
            alert('Wiadomość została wysłana na adres email podany przy rejestracji!');
        }
        else
        {
            alert('Podany login nie istnieje!');
        }
    }
    elseif(!empty($_GET["r"]) && !empty($_GET["e"]))
    {
        $random = $_GET["r"];
        $email_from_get = $_GET["e"];

        if($_POST['finish']) // 3RD STEP
		{
            if(!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["password_repeat"]) && !empty($_POST["random"]))
            {
                $email = $_POST["email"];
				$password = $_POST["password"];
				$password_repeat = $_POST["password_repeat"];
                $random = $_POST["random"];
                
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    forgotAlert('Nieprawidłowy adres email!');
                }
                if($password != $password_repeat)
                {
                    forgotAlert('Podane hasła nie są takie same!');
                }
                if(strlen($password) < 4 || strlen($password) > 16)
                {
                    forgotAlert('Hasło musi posiadać od 4 do 16 znaków!');
                }

                $stmt = $sql->prepare('SELECT `email` FROM `account` WHERE `email`=? AND `random_forgot`=?');
				$stmt->execute([$email, $random]);
                $email = $stmt->fetchColumn();
                if($email)
				{
					$sql->prepare('UPDATE `account` SET `password`=PASSWORD(?), `random_forgot`=NULL WHERE `email`=?')->execute([$password, $email]);
					$step = 3;
				}
				else
				{
					alert('Twój link wygasł! Spróbuj ponownie jeszcze raz!');
				}
            }
            else
			{
				forgotAlert('Wszystkie pola muszą być uzupełnione!');
			}
        }

        if($step != 3)
		{
			$stmt = $sql->prepare('SELECT `email` FROM `account` WHERE `random_forgot`=?');
			$stmt->execute([$random]);
			$email = $stmt->fetchColumn();
			if(md5($email) == $email_from_get)
			{
				$step = 2;
			}
			else
			{
				alert('Twój link wygasł! Spróbuj ponownie jeszcze raz!');
			}
		}
    }

	
    require_once './include/contents/forgot_content.php';
	
    require_once './include/footer.php';
?>
