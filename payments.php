<?php
    ob_start();
    $title = "Smocze Monety - ";
    $data = "payments";
    require_once './include/header.php';

    is_login(true);

    $content .= '<div class="title-bg">';
      $content .= '<h1>Smocze Monety</h1>';
    $content .= '</div>';
    $content .= '<div class="content">';
      $content .= '<br><br>';
      $content .= '<center><i style="font-size: 50px" class="fas fa-tools"></i></center>';
      $content .= '<br>';
      $content .= '<center>Wkrótce coś się pojawi</center>';
    $content .= '</div>';

    require_once './include/footer.php';
?>
