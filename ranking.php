<?php
    $title = "Ranking - ";
    $data = "ranking";
    require_once './include/header.php';

    if(isset($_GET['page'])) $page = $_GET['page'];
    if(!isset($page) || !is_numeric($page) || $page < 1 || filter_var($page, FILTER_VALIDATE_INT) === false)
        $page = 1;

    $records = 20;
    $start = ($page-1) * $records;

    $num_of_rows = $sql->query('SELECT count(*) FROM `player`.`player` WHERE `name` NOT LIKE \'[%\'')->fetchColumn();
    $end = intval($num_of_rows/$records)+1;
    if($start >= $num_of_rows)
    {
        $start = intval($num_of_rows/$records)*$records;
        $page = $end;
    }


        $content .= '<div class="title-bg">';
            $content .= '<h1>RANKING</h1>';
        $content .= '</div>';
        $content .= '<div class="content">';
          $content .= '<form id="search"><div class="search-box">';
              $content .= '<input type="text" class="search-bar" placeholder="Szukaj ..." name="nick">';
              $content .= '<a href="javascript:submitRank()" class="search-btn">';
                  $content .= '<i class="fas fa-search"></i>';
              $content .= '</a>';
        $content .= '</div></form>';

        $content .= '<table>';
            $content .= '<thead><tr><th class="tb-pos">#</th><th colspan="3">Nick</th><th colspan="2">Poziom</th></tr></thead>';

            if(!isset($_GET['nick']))
            {
                $stmt = $sql->query('SELECT `name`, `playtime`, `level`, `empire`, `job` FROM `player`.`player` INNER JOIN `player`.`player_index` ON `player`.`player`.`account_id` = `player`.`player_index`.`id` WHERE `name` NOT LIKE \'[%\' ORDER BY `level` DESC, `playtime`, `name` LIMIT '.$start.','.$records);
                $rank = $start+1;
            }
            else
            {
                $stmt = $sql->prepare('SELECT `rank`, `name`, `playtime`, `level`, `job`, `account_id` FROM (SELECT @rank:=@rank+1 AS `rank`, `name`, `playtime`, `level`, `job`, `account_id` FROM `player`.`player`, (SELECT @rank := 0) r ORDER BY `level` DESC, `playtime`, `name`) t WHERE `name` = ?');
                $stmt->execute([$_GET['nick']]);
                $stmt = $stmt->fetchAll();
                $rank = $stmt[0]['rank'];
                if(!$stmt)
                    alert_to_rank('Podany gracz nie istnieje!');
                $cont = $sql->query('SELECT `empire` FROM `player`.`player_index` WHERE `id` = '.$stmt[0]['account_id'])->fetchColumn();
            }

            foreach($stmt as $contentow)
            {
                ($contentow['empire']) ? $id = checkCountry($contentow['empire']) : $id = checkCountry($cont);
                $content .= '<tbody class="labels"><tr><td class="tb-pos">'.$rank.'</td><td colspan="3">'.$contentow['name'].'<input type="checkbox" id="'.$contentow['name'].'" data-toggle="toggle"></td><td></td><td>'.$contentow['level'].'</td></tr></tbody>';
                $content .= '<tbody class="hide">';
                    $content .= '<tr><td></td><td></td><td colspan="2">Klasa:</td><td colspan="2">'.checkJob($contentow['job']).'</td></tr>';
                    $content .= '<tr><td></td><td></td><td colspan="2">Królestwo:</td><td></td><td colspan="2"><img class="village" src="img/'.$id.'.png"></td></tr>';
                    $content .= '<tr><td></td><td></td><td colspan="2">Czas gry:</td><td></td><td colspan="2">'.secondsToTime($contentow['playtime']).'</td></tr>';
                $content .= '</tbody>';
                $rank++;
            }

        $content .= "</table>";

        $content .= '</section>';
        $content .= '<section class="bottom">';
            $content .= '<div class="pagination">';
                $content .= '<a href="ranking?page=1" data-first><i class="fas fa-angle-double-left"></i></a>';
                ($page < 2) ? $prev = 1 : $prev = $page - 1;
                $content .= '<a href="ranking?page='.$prev.'" data-prev><i class="fas fa-angle-left"></i></a>';
                for($i=-2; $i<3; $i++)
                {
                    $li = $page + $i;
                    if($li<1) continue;
                    $lic = ($li*$records)-$records;
                    if($lic>$num_of_rows) break;
                    if($page == $li && !isset($_GET['nick']))
                        $content .= '<a href="ranking?page='.$li.'" data-normal class="active-page">'.$li.'</a>';
                    else
                        $content .= '<a href="ranking?page='.$li.'" data-normal>'.$li.'</a>';
                }
                $content .= '<a href="ranking?page='.$end.'" data-next><i class="fas fa-angle-double-right"></i></a>';
                ($page >= $end) ? $next = $end : $next = $page + 1;
                $content .= '<a href="ranking?page='.$next.'" data-last><i class="fas fa-angle-right"></i></a>';
            $content .= '</div>';
        $content .= '</section>';

    require_once './include/footer.php';
?>
