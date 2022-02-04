<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    require_once 'config.php';

    $content = '<!DOCTYPE html>';
        $content .= '<html lang="pl" dir="ltr">';
        $content .= '<head>';
            $content .= '<meta charset="utf-8">';
            $content .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=yes">';
            //$content .= '<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />';
            $content .= '<meta name="author" content="biongoo">';
            $content .= '<meta http-equiv="X-Ua-Compatible" content="IE=edge">';

            $content .= '<title>'.$title.'ShereMT2 - Prywatny serwer Metin2</title>';
            $content .= '<link rel="icon" href="/img/favicon.ico" type="image/x-icon">';
            //$content .= '<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">';
            //$content .= '<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">';
            $content .= '<base href="'.$name.'" target="_parent">';

            $content .= '<meta name="keywords" content="shere, sheremt2, metin, metin2, prywatny serwer metin, server no-hamachi, polski metin, serwer prywatny, metin2 priv, serwer metina, priv servers, polski priv metin, globalny metin2 pl, metin2 prywatny, polski metin, no-hamachi, dedykowany priv, aktualności">';
            $content .= '<meta name="description" content="ShereMT2 - Witaj w cudownym świecie MMORPG. Nowo powstały serwer przyniesie Ci wiele wrażeń i doznań. Nie poddawaj się, zostań mistrzem zachodnich sztuk walki!">';

            $content .= '<meta name="googlebot" content="index, follow">';
            $content .= '<meta name="robots" content="index, follow">';
            $content .= '<meta name="distribution" content="global">';

            // CSS
            $content .= '<link rel="stylesheet" href="css/main.css">';
            $content .= '<link rel="stylesheet" href="css/'.$data.'.css">';
            $content .= '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">';

			$content .= '<script src="https://www.google.com/recaptcha/api.js"></script>';
            $content .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
            $content .= '<script src="js/main.js"></script>';

        $content .= '</head>';
        $content .= '<body>';
        $content .= '<div class="container">';

            $content .= '<header>';

                $content .= '<img src="css/elements/banner.png" alt="ShereMT2">';

            $content .= '</header>';

            $content .= '<nav>';

                $content .= '<ul class="nav">';

                    $content .= '<li><a href="">Strona Główna</a></li>';
                    $content .= '<li><a href="register">Rejestracja</a></li>';
                    $content .= '<li><a href="download">Pobierz grę</a></li>';
                    $content .= '<li><a href="itemshop">Item Shop</a></li>';
                    $content .= '<li><a href="payments">Smocze Monety</a></li>';
                    $content .= '<li><a href="ranking">Ranking</a></li>';
                    $content .= '<li><a href="forum">Forum</a></li>';

                $content .= '</ul>';

                $content .= '<ul class="status">';

                $i = 'Logowanie';
                foreach($ports as $port)
                {
                    $status = checkPort($port);
                    ($status) ? $status = 'yes' : $status = 'no';
                    $content .= '<li>';
                        if($i == 'Logowanie') 
                        {
                            $content .= '<span>'.$i.'</span>';
                            $i = 0;
                        }
                        else
                            $content .= '<span>Kanał '.$i.'</span>';
                        $content .= '<img src="css/elements/'.$status.'.png" title="">';
                    $content .= '</li>';
                    $i++;
                }
                unset($i);

                $content .= '</ul>';

            $content .= '</nav>';

            $content .= '<main>';
                $content .= '<section class="top"></section>';
                $content .= '<section class="middle">';
?>
