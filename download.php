<?php
    $title = "Pobierz Grę - ";
    $data = "download";
    require_once './include/header.php';

    $stmt = $sql->query('SELECT * FROM `site`.`download`')->fetchAll();
    $result = $stmt[0];
    //alert_to_home($result['date']);

    
    if(isset($_POST['down']))
    {
        $stmt = $sql->query('UPDATE `site`.`download` SET `downloads`=`downloads`+1');
        header('Location: '.$result['link']);
		exit;
    }

    $content .= '<form id="download" method="POST"><input type="hidden" name="down"></form>';

    $content .= '<div class="title-bg">';
        $content .= '<h1>Pobierz grę</h1>';
    $content .= '</div>';
    $content .= '<div class="content">';
        $content .= '<div class="download-bg">';
            $content .= '<div class="border-wrap">';
                $content .= '<a href="javascript:download()">';
                    $content .= '<i class="fas fa-download"><span>Pobierz</span></i>';
                    $content .= '</a>';
            $content .= '</div>';
        $content .= '</div>';
        $content .= '<ul class="info-bar">';
            $content .= '<li><p>Rozmiar pliku</p><b>'.$result['size'].' GB</b></li>';
            $content .= '<li><p>Ostatnia aktualizacja</p><b>'.$result['date'].'</b></li>';
            $content .= '<li><p>Liczba pobrań</p><b>'.$result['downloads'].'</b></li>';
        $content .= '</ul>';
        $content .= '<div class="header-bg">';
            $content .= '<h4>Wymagania sprzętowe</h4>';
        $content .= '</div>';
            $content .= '<div class="requirements">';
                $content .= '<h4>Procesor</h4>';
                $content .= '<span>Procesor 1 GHz lub szybszy</span>';
                $content .= '<h4>Karta graficzna</h4>';
                $content .= '<span>Urządzenie graficzne z obsługą programu DirectX 9</span>';
                $content .= '<h4>Pamięć RAM</h4>';
                $content .= '<span>1 GB</span>';
                $content .= '<h4>System operacyjny</h4>';
                $content .= '<span>Windows 7</span>';
          $content .= '</div>';
  	$content .= '</div>';

    require_once './include/footer.php';
?>