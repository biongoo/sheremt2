<?php
        $title = "Ustawienia - ";
		$data = "settings";
        require_once './include/header.php';

		is_login(true);

    $content .= '<a class="back-btn" href="../account"><i class="fas fa-arrow-alt-circle-left"></i> Powrót</a>';
		$content .= '<div class="content">';
			$content .= '<div class="header-bg">';
				$content .= '<h2>Ustawienia</h2>';
			$content .= '</div>';
      $content .= '<a class="settings-btn" href="./chg_pswd"><i class="fas fa-key"></i>Zmień hasło</a>';
      $content .= '<a class="settings-btn" href="./chg_email"><i class="fas fa-envelope"></i>Zmień adres e-mail</a>';
      $content .= '<a class="settings-btn" href="./remind_code"><i class="fas fa-user-tag"></i>Przypomnij kod usunięcia postaci</a>';
      $content .= '<a class="settings-btn" href="./remind_shop"><i class="fas fa-warehouse"></i>Przypomnij hasło do magazynu</a>';
		$content .= '</div>';

		require_once './include/footer.php';
?>
