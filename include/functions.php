<?php
    use PHPMailer\PHPMailer\PHPMailer;

    function alert($info)
    {
        global $data;
        $_SESSION['msg'] = $info;
        header('Location: /'.$data);
		exit;
    }

    function alert_to_acc($info)
    {
        $_SESSION['msg'] = $info;
        header('Location: /account');
		exit;
    }

    function alert_to_home($info)
    {
        $_SESSION['msg'] = $info;
        header('Location: /');
		exit;
    }

    function alert_to_rank($info)
    {
        $_SESSION['msg'] = $info;
        header('Location: /ranking');
		exit;
    }

    function alert_to_settings($info)
    {
        $_SESSION['msg'] = $info;
        header('Location: /settings');
		exit;
    }

    function captchaCheck()
    {
        global $_POST;
        global $data;

        $captcha=$_POST['g-recaptcha-response']; 

        if(!$captcha)
		{
			alert('Kod Captcha jest nieprawidłowy!');
		}
		$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdHi4UUAAAAAD3kyS3I25OC7qrxclbYc16loxKY&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
		if($response['success'] == false)
        {
			alert('Kod Captcha jest nieprawidłowy!');
        }
    }

    function checkAlert($info)
    {
        global $random, $email_from_get;
        $_SESSION['msg'] = $info;
		header('Location: /register.php?r='.$random.'&e='.$email_from_get);
		exit;
    }

    function checkCountry($id)
    {
        switch ($id)
        {
            case 1:
                $id = 'red';
                break;
            case 2:
                $id = 'yellow';
                break;
            case 3:
                $id = 'blue';
                break;
        }
        return $id;
    }

    function checkFields()
    {
        global $email, $login, $password, $password_repeat, $real_name, $social_id;
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			checkAlert('Nieprawidłowy adres email!');

		if($password != $password_repeat)
		    checkAlert('Podane hasła nie są takie same!');

		if(strlen($login) < 4 || strlen($login) > 30)
            checkAlert('Login musi posiadać od 4 do 30 znaków!');

		if(strlen($password) < 4 || strlen($password) > 16)
            checkAlert('Hasło musi posiadać od 4 do 16 znaków!');

		if(strlen($real_name) < 3 || strlen($real_name) > 15)
            checkAlert('Imię musi posiadać od 3 do 15 znaków!');

		if(strlen($social_id) != 7)
            checkAlert('Kod usunięcia postaci musi posiadać 7 znaków!');
    }

    function checkJob($id)
    {
        switch($id)
        {
            case 0:
                $id = 'Wojownik';
                break;
            case 1:
                $id = 'Ninja';
                break;
            case 2:
                $id = 'Sura';
                break;
            case 3:
                $id = 'Szamanka';
                break;
            case 4:
                $id = 'Wojowniczka';
                break;
            case 5:
                $id = 'Ninja';
                break;
            case 6:
                $id = 'Surka';
                break;
            case 7:
                $id = 'Szaman';
                break;
        }
        return $id;
    }

    function checkPort($port)
    {
        /*global $server_ip;
        $connection = @fsockopen($server_ip, $port, $errno, $errstr, 1);
        if($connection) 
        {
            fclose($connection);
			return true;
        } 
        else 
        {
			return false;
        }*/
        
        return false;
    }

    function clearDatabase() 
    {
        global $sql;
        $now = time();
		$date = $sql->query('SELECT `time`, `id` FROM `account` WHERE `time`>0')->fetchAll();
		foreach($date as $row)
		{
			$roznica = $now - $row['time'];
			if($roznica>=86400) { $sql->query('DELETE FROM `account` WHERE `id`="'.$row['id'].'"'); }
		}
    }

    function emailValidation()
    {
        global $email, $data;

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			alert('Nieprawidłowy adres email!');
    }

    function forgotAlert($info)
    {
        global $random, $email_from_get;
        $_SESSION['msg'] = $info;
		header('Location: /forgot.php?r='.$random.'&e='.$email_from_get);
		exit;
    }

    function forgotMail($email, $random)
    {
        global $name;
        $mail = new PHPMailer(TRUE);

        $message = '<html><head></head><body>';
		$message .= '<center><b>Witaj Graczu!</b><br>Aby zresetować swoje hasło kliknij w <b><a href="'.$name.'forgot?r='.$random.'&e='.md5($email).'">ten link</a></b>!';
		$message .= '<br><br>ShereMT2.pl &copy; Wszelkie prawa zastrzeżone</center>';
		$message .= '</body></html>';

        try {
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('admin@sheremt2.pl', 'ShereMT2');
            $mail->addAddress($email);
            $mail->Subject = 'ShereMT2.pl - Zmiana hasła';
            $mail->isHTML(TRUE);
            $mail->Body = $message;
            $mail->send();  
        }
        catch (Exception $e)
        {
            echo $e->errorMessage();
        }
        catch (\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    function getSM()
    {
        global $sql;
        $stmt = $sql->prepare('SELECT `cash` FROM `account` WHERE `login`=?');
        $stmt->execute([$_SESSION['login']]);
        $SM = $stmt->fetchColumn();
        return $SM;
    }

    function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function is_login($var) 
    {
        switch ($var) 
	    {
            case 0:
                if(isset($_SESSION['login']))
                {
                    alert_to_home('Jesteś aktualnie zalogowany!');
                }
                break;
            case 1:
                if(!isset($_SESSION['login']))
                {
                    alert_to_home('Nie jesteś zalogowany!');
                }
                break;
        }
    }

    function login($login, $password)
    {
        global $now;
        if(!empty($login) && !empty($password)) 
        {
            if(strlen($login) <= 3 || strlen($password) <= 3)
            {
                alert_to_home('Login lub hasło są nieprawidłowe!!');
            }

            global $sql;
            $stmt = $sql->prepare('SELECT `login`, `real_name`, `last_ip`, `email`, `status`, `id`, `availDt`, `reason` FROM `account` WHERE `login`=? AND `password`=PASSWORD(?)');
            $stmt->execute([$login, $password]);
            $count = $stmt->fetch();
            $login = $count[0]; $name = $count[1]; $last_ip = $count[2]; $email = $count[3]; $status = $count[4]; $id = $count[5]; $availDt = $count[6]; $reason = $count[7];
            if($login)
            {
                $ip = getRealIpAddr();
                if($status == 'BLOCK')
                    alert_to_home('Twoje konto zostało permanentnie zablokowane! Powód: '.$reason.'.');
                if($status == 'UN')
                    alert_to_home('Twoje konto nie zostało potwierdzone!');
                if(strtotime($availDt)>$now)
                    alert_to_home('Twoje konto zostało czasowo zablokowane! Powód: '.$reason.'. Będziesz mógł się zalogować: '.$availDt);

                $sql->prepare('UPDATE `account` SET `last_ip`=? WHERE `login`=?')->execute([$ip, $login]);

                $stmt = $sql->prepare('SELECT `ips`.`id_account` FROM `site`.`ips` INNER JOIN `account`.`account` ON `ips`.`id_account` = `account`.`id` WHERE `login`=? AND `ip`=?'); // Add IP to database
                $stmt->execute([$login, $ip]);
                $answer = $stmt->fetchColumn();
                if(!$answer)
                    $sql->prepare('INSERT INTO `site`.`ips` (`id_account`, `ip`) VALUES (?,?)')->execute([$id, $ip]);

                $_SESSION['login'] = $login; $_SESSION['id'] = $id; $_SESSION['name'] = $name; $_SESSION['password'] = $password; $_SESSION['last_ip'] = $last_ip; $_SESSION['email'] = $email;
                alert_to_acc('Zalogowano pomyślnie!');
            }
            else
            {
                alert_to_home('Podane dane są nieprawidłowe!');
            }
        }
    }

    function logout($info) 
    {
        unset($_SESSION['login']); unset($_SESSION['password']); unset($_SESSION['name']); unset($_SESSION['last_ip']); unset($_SESSION['email']); unset($_SESSION['id']);
        alert_to_home($info);
    }

    function newRandom()
    {
        global $random;
        $length = 50;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $random = '';
        for ($i = 0; $i < $length; $i++) 
        {
            $random .= $characters[rand(0, $charactersLength - 1)];
        }
        //for($i=1;$i<=4;$i++) { (!$random) ? $random = uniqid() : $random .= uniqid(); }
    }
    
    function registerMail($email, $name, $random)
    {
        $mail = new PHPMailer(TRUE);

        $message = '<html><head></head><body>';
		$message .= '<center><b>Witaj Graczu!</b><br>Dziękujemy za chęć dołączenia do niesamowitej społeczności ShereMT2.pl!<br>Aby potwierdzić swój email kliknij w <b><a href="'.$name.'register.php?r='.$random.'&e='.md5($email).'">ten link</a></b>!';
		$message .= '<br>Jeżeli to nie Ty dokonałeś rejestracji na ShereMT2.pl - zignoruj tę wiadomość!<br><br>ShereMT2.pl &copy; Wszelkie prawa zastrzeżone</center>';
		$message .= '</body></html>';

        try {
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('admin@sheremt2.pl', 'ShereMT2');
            $mail->addAddress($email);
            $mail->Subject = 'ShereMT2.pl - Aktywacja konta';
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
        }
    }

    function secondsToTime($seconds) {
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        if($seconds<3600)
            return $dtF->diff($dtT)->format('%im');
        elseif($seconds<86400)
            return $dtF->diff($dtT)->format('%hg, %im');
        else
            return $dtF->diff($dtT)->format('%ad, %hg, %im');
    }
?>