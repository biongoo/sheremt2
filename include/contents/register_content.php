<?php
	switch ($step) 
	{
		case 1:
			$content .= '<div class="content">';
				$content .= '<div class="header-bg">';
					$content .= '<h1>Rejestracja</h1>';
				$content .= '</div>';
				$content .= '<form name="step1" class="step1" action="" method="POST">';
					$content .= '<label for="email">Email</label>';
					$content .= '<input type="email" name="email" required>';
					//$content .= '<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LdHi4UUAAAAABGkctzW3bzSGrMGGP_bOtSTKVzB"></div>';
					$content .= '<span class="reg">Oświadczam, że zapoznałem/am się z treścią <a href="#">regulaminu serwisu</a> i akceptuje powyższe warunki.</span>';
					$content .= '<div class="border-wrap">';
						$content .= '<input type="submit" class="button" './*onclick="send()"*/ ' name="reg_butt" value="Wyślij">';
					$content .= '</div>';
					$content .= '<ul class="progress-bar">';
						$content .= '<li class="active">1. KROK</li>';
						$content .= '<li>2. KROK</li>';
						$content .= '<li>3. KROK</li>';
					$content .= '</ul>';
				$content .= '</form>';
			$content .= '</div>';
			break;
		case 2:
			$content .= '<div class="content">';
				$content .= '<div class="header-bg">';
					$content .= '<h1>Rejestracja</h1>';
				$content .= '</div>';
				$content .= '<form name="step2" class="step2" action="" method="POST">';
					$content .= '<input type="email" name="email" required readonly value="'.$email.'"><label>Email</label>';
					$content .= '<input type="text" name="login" required><label>Login (4-30 znaków)</label>';
					$content .= '<input type="password" name="password" required><label>Hasło (4-16 znaków)</label>';
					$content .= '<input type="password" name="password_repeat" required><label>Powtórz hasło</label>';
					$content .= '<input type="text" name="real_name" required><label>Imię (3-20 znaków)</label>';
					$content .= '<input type="text" name="social_id" required><label>Kod usunięcia postaci (7 znaków)</label>';
					$content .= '<div class="border-wrap">';
						$content .= '<input type="submit" class="button" name="finish" value="Wyślij">';
					$content .= '</div>';
					$content .= '<input type="hidden" name="random" value="'.$random.'">';
					$content .= '<ul class="progress-bar">';
						$content .= '<li class="active">1. KROK</li>';
						$content .= '<li class="active">2. KROK</li>';
						$content .= '<li>3. KROK</li>';
					$content .= '</ul>';
				$content .= '</form>';
			$content .= '</div>';
			break;
		case 3:
				$content .= '<div class="content">';
					$content .= '<div class="header-bg">';
						$content .= '<h1>Sukces</h1>';
					$content .= '</div>';
					$content .= '<form name="step3" class="step1">';
						$content .= '<p>Rejestracja przebiegła pomyślnie. Możesz się już zalogować na swoje konto.</p>';
						$content .= '<ul class="progress-bar">';
							$content .= '<li class="active">1. KROK</li>';
							$content .= '<li class="active">2. KROK</li>';
							$content .= '<li class="active">3. KROK</li>';
						$content .= '</ul>';
					$content .= '</form>';
				$content .= '</div>';
			break;
	}
?>
