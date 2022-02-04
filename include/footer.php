<?php
            $content .= '</section>';

            if($data != 'ranking')
            {
                $content .= '<section class="bottom">';
                    $content .= '<a href="#top" class="to-top"></a>';
                $content .= '</section>';
            }
            $content .= '</main>';

            $content .= '<aside>';

                $content .= '<div class="login-box">';
                    require_once './include/contents/login_content.php';
                $content .= '</div>';

                $content .= '<ol class="ranking">';
                    $stmt = $sql->query('SELECT `name`, `level` FROM `player`.`player` ORDER BY `level` DESC, `playtime`, `name` LIMIT 5');
                    foreach($stmt as $row)
                    {
                        //$content .= '<li title="'.$row['name'].'"><span>'.$row['name'].' - '.$row['level'].'</span></li>';
                        $content .= '<li title="'.$row['name'].'"><span>'.$row['name'].'</span><span>'.$row['level'].' lv</span></li>';
                    }
                $content .= '</ol>';

            $content .= '</aside>';

            $content .= '<footer>';

                $content .= '<span>ShereMT2.pl &copy; Wszelkie prawa zastrzeżone</span>';

            $content .= '</footer>';

            if(file_exists('js/'.$data.'.js'))
                $content .= '<script src="js/'.$data.'.js"></script>';

            if(isset($_SESSION['msg']))
            {
                $content .= '<script>alercik(\''.$_SESSION['msg'].'\')</script>';
                unset($_SESSION['msg']);
            }

        $content .= '</div>';
        $content .= '</body>';
    $content .= '</html>';

    echo $content;
?>
