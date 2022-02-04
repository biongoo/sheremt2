<?php
    $title = '';
    $data = 'home';
    require_once './include/header.php';

        $content .= '<div class="bg-overlay"></div>';
            $stmt = $sql->query('SELECT * FROM `articles`')->fetchAll();
            foreach($stmt as $row)
            {
                $content .= '<article>';
                    $content .= '<h3>'.$row['title'].'</h3>';
                    $content .= '<p>'.$row['content'].'</p>';
                    $content .= '<span class="author">Dodał: '.$row['author'].', '.$row['date'].'</span>';
                    $content .= '<span class="more">Zobacz więcej</span>';    
                $content .= '</article>';
            }
            /*$content .= '<div class="pagination">';
                $content .= '<a href="" data-first>&#11160;</a>';
                $content .= '<a href="" data-prev>&#11160;&#11160;</a>';
                $content .= '<a href="" data-normal class="active-page">1</a>';
                $content .= '<a href="" data-normal>2</a>';
                $content .= '<a href="" data-normal>3</a>';
                $content .= '<a href="" data-normal>4</a>';
                $content .= '<a href="" data-normal>5</a>';
                $content .= '<a href="" data-next>&#11162;</a>';
                $content .= '<a href="" data-last>&#11162;&#11162;</a>';
            $content .= '</div>';*/

    require_once './include/footer.php';
?>
