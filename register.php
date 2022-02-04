<?php
    $title = "Rejestracja - ";
    $data = "register";
	require_once './include/header.php';

	is_login(false);

	$step = 1;

	if(isset($_POST['reg_butt'])) // 1ST STEP
	{
		//captchaCheck(); // CAPTCHA
		clearDatabase(); // Usuwanie starych
		
		$email = $_POST['email']; // Przypisanie zmiennej

		emailValidation(); // Walidacja emial
		newRandom(); // Tworzenie zmiennej

		$stmt = $sql->prepare('SELECT `email`, `random` FROM `account` WHERE `email`=?');
		$stmt->execute([$email]);
		$count = $stmt->fetch();
		$email_exists = $count[0];
		$random_exists = $count[1];
		if($email_exists)
		{
			if($random_exists)
			{
				$sql->prepare('UPDATE `account` SET `time`=?, random=? WHERE `email`=?')->execute([$now, $random, $email]);
				registerMail($email, $name, $random); // Wysłanie email
				alert('Wysłaliśmy ponownie link na Twoją pocztę! Masz dzień na dokończenie rejestracji :)');
			}
			else
			{
				alert('Podany email jest już zajęty!');
			}
		}
		else
		{
			$sql->prepare('INSERT INTO `account` (`email`, `random`, `time`) VALUES (?, ?, ?)')->execute([$email, $random, $now]);
			registerMail($email, $name, $random); // Wysłanie email
			alert('Został wysłany link aktywacyjny na Twoją pocztę! Masz dzień na dokończenie rejestracji :)');
		}
		
	}
	elseif(!empty($_GET["r"]) && !empty($_GET["e"])) // 2ND STEP
	{
		$random = $_GET["r"];
		$email_from_get = $_GET["e"];
		
		if(isset($_POST['finish'])) // 3RD STEP
		{
			if(!empty($_POST["email"]) && !empty($_POST["login"]) && !empty($_POST["password"]) && !empty($_POST["password_repeat"]) && !empty($_POST["real_name"]) && !empty($_POST["social_id"]) && !empty($_POST["random"])) 
			{
				$email = $_POST["email"];
				$login = $_POST["login"];
				$password = $_POST["password"];
				$password_repeat = $_POST["password_repeat"];
				$real_name = $_POST["real_name"];
				$social_id = $_POST["social_id"];
				$random = $_POST["random"];

				checkFields();

				$stmt = $sql->prepare('SELECT `email` FROM `account` WHERE `email`=? AND `random`=?');
				$stmt->execute([$email, $random]);
				$email = $stmt->fetchColumn();
				if($email)
				{
					$stmt = $sql->prepare('SELECT `login` FROM `account` WHERE `login`=?');
					$stmt->execute([$login]);
					$login_exists = $stmt->fetchColumn();
					if(!$login_exists)
					{
						$sql->prepare('UPDATE `account` SET `login`=?, `password`=PASSWORD(?), `real_name`=?, `social_id`=?, create_time=NOW(), `time`=0, `status`="OK", `random`=NULL, `create_ip`=? WHERE `email`=?')
						->execute([$login, $password, $real_name, $social_id, getRealIpAddr(), $email]);
						$step = 3;
					}
					else
					{
						checkAlert('Podany login jest juz zajęty');
					}
				}
				else
				{
					alert('Twój link wygasł! Spróbuj ponownie jeszcze raz!');
				}
			}
			else
			{
				checkAlert('Wszystkie pola muszą być uzupełnione!');
			}
		}
		if($step != 3)
		{
			$stmt = $sql->prepare('SELECT `email` FROM `account` WHERE `random`=?');
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

	require_once './include/contents/register_content.php';

    require_once './include/footer.php';
?>
