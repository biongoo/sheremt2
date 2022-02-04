<?php
        $title = "Historia transakcji - ";
		$data = "history";
        require_once './include/header.php';

		is_login(true);

    $content .= '<a class="back-btn" href="../account"><i class="fas fa-arrow-alt-circle-left"></i> Powrót</a>';
		$content .= '<div class="content">';
			$content .= '<div class="header-bg">';
				$content .= '<h1>Historia transakcji</h1>';
			$content .= '</div>';

      $content .= '<table>';
		   $content .= '<tr><th>ID</th><th>NAZWA</th><th>KOSZT</th><th>SALDO PO OPERACJI</th></tr>';
       $content .= '<tr><td>1</td><td>ABC</td><td>4 kasztany</td><td>10 jenów chińskich</td></tr>';
       $content .= '<tr><td>2</td><td>BardzoDlugaNazwaCzegosCoSluzyDoTestow</td><td>BardzoDlugaNazwaKosztu</td><td>DlugaNazwaTest</td></tr>';
       $content .= '<tr><td>3</td><td>test</td><td>10</td><td>50</td></tr>';
      $content .= '</table>';
		$content .= '</div>';

		require_once './include/footer.php';
?>
