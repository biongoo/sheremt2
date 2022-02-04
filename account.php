<?php
        $title = "Twoje konto - ";
		$data = "account";
        require_once './include/header.php';

        is_login(true);
        
        if(isset($_POST['un_nick']))
        {
            $nick = $_POST['un_nick'];
            $stmt = $sql->prepare('SELECT COUNT(*) FROM `player`.`player` WHERE `name` = ? AND `account_id` = ?');
            $stmt->execute([$nick, $_SESSION['id']]);
            $result = $stmt->fetchColumn();

            if($result)
            {
                $date = date("Y-m-d H:i:s");
                $date_af_30min = date("Y-m-d H:i:s", strtotime($date . "+30 minutes"));
                //alert($date_af_30min);
                $stmt = $sql->prepare('UPDATE `player`.`player` INNER JOIN `account`.`account` ON `player`.`player`.`account_id` = `account`.`account`.`id` SET `x`=436377, `y`=215769, `map_index`=61, `exit_x`=436378, `exit_y`=215769, `exit_map_index`=61, `availDt`=\''.$date_af_30min.'\', `reason`="Odbugowywanie postaci" WHERE `name`=? AND `account_id`=?')->execute([$nick, $_SESSION['id']]);
                logout('Twoje konto zostało zablokowane na 30 minut aby wprowadzić zmiany! Wyloguj się z gry!');
            }
            else
                alert('Nie kombinuj Panie drogi!');
        }

		$content .= '<div class="content">';
			$content .= '<div class="header-bg">';
				$content .= '<h3>Twoje konto</h3>';
			$content .= '</div>';

			$content .= '<div class="stats">'; /// EDIT
                $content .= '<div class="wrapper">';
                    $content .= '<a href="/history"><i class="fas fa-file-invoice-dollar"></i>  Historia transakcji</a>';
                    $content .= '<a href="/settings"><i class="fas fa-cogs"></i>  Ustawienia</a>';
                $content .= '</div>';
                $content .= '<hr>';
                $content .= '<table>';
                    $content .= '<tr><td>Login: </td>';
                    $content .= '<td>'.$_SESSION['login'].'</td></tr>';
                    $content .= '<tr><td>E-mail: </td>';
                    $content .= '<td>'.$_SESSION['email'].'</td></tr>';
                    $content .= '<tr><td>Data utworzenia konta: </td>';
                    $content .= '<td>12-12-2018</td></tr>';
                    $content .= '<tr><td>Ostatnie IP na stronie: </td>';
                    $content .= '<td>'.$_SESSION['last_ip'].'</td></tr>';
                $content .= '</table>';
            $content .= '</div>';

			$content .= '<div class="header-bg">';
				$content .= '<h3>Twoje postacie</h3>';
            $content .= '</div>';

            $stmt = $sql->prepare('SELECT `name`, `job`, `level` FROM `player`.`player` WHERE `account_id`=?');
            $stmt->execute([$_SESSION['id']]);
            $var = $stmt->fetchAll();

            $k = 0;
            foreach($var as $row)
            {
              $content .= '<div class="character-bg">';
                  $content .= '<img class="avatar" src="img/characters/'.$row['job'].'.png">';
                  $content .= '<div class="character-stats"><ul><li>'.$row['name'].'</li><li>Level '.$row['level'].'</li><li>'.checkJob($row['job']).'</li></ul></div>';
                  $content .= '<form id="unbugform" method="POST">';
                    $content .= '<a class="bug" href="javascript:unbug(\''.$row['name'].'\')"><i class="fas fa-bug"></i></a>';
                    $content .= '<div class="notification">Odbuguj</div>';
                  $content .= '</form>';
              $content .= '</div>';
              $k++;
            }

            for($i = $k; $i<4; $i++)
            {
              $content .= '<div class="character-bg">';
                $content .= '<div class="avatar"></div>';
                $content .= '<div class="character-stats"><ul class="empty"><li>Nazwa</li><li>Level</li><li>Klasa</li></ul></div>';
              $content .= '</div>';
            }

		$content .= '</div>';

		require_once './include/footer.php';
?>
