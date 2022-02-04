<?php
	switch ($step) 
	{
		case 1:
			$content .= '<div class="content">';
				$content .= '<div class="header-bg">';
					$content .= '<h1>Zmień hasło</h1>';
				$content .= '</div>';
				$content .= '<form name="step1" class="step1" method="POST">';
					$content .= '<label for="old_paswd">Podaj swoje aktualne hasło:</label>';
					$content .= '<input type="password" name="old_paswd" required>';
					$content .= '<label for="new_paswd">Podaj nowe hasło:</label>';
					$content .= '<input type="password" name="new_paswd" required>';
					$content .= '<label for="repeat_new_paswd">Powtórz nowe hasło:</label>';
					$content .= '<input type="password" name="repeat_new_paswd" required>';
					//$content .= '<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LdHi4UUAAAAABGkctzW3bzSGrMGGP_bOtSTKVzB"></div>';
					$content .= '<div class="border-wrap">';
						$content .= '<input type="submit" class="button" name="reg_butt" value="Zmień hasło">';
					$content .= '</div>';
				$content .= '</form>';
			$content .= '</div>';
			break;
		case 2:
			$content .= '<div class="content">';
				$content .= '<div class="header-bg">';
					$content .= '<h1>Zmień hasło</h1>';
				$content .= '</div>';
				$content .= '<form name="step2" class="step2" method="POST">';
					$content .= '<input type="email" name="email" readonly required value="'.$email.'"><label>Email</label>';
					$content .= '<input type="password" name="password" required><label>Nowe hasło (4-16 znaków)</label>';
					$content .= '<input type="password" name="password_repeat" required><label>Powtórz nowe hasło</label>';
					$content .= '<div class="border-wrap">';
						$content .= '<input type="submit" class="button" name="finish" value="Wyślij" >';
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
					$content .= '<p>Hasło zostało pomyślnie zmienione! Możesz się już zalogować na swoje konto.</p>';
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
