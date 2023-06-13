<?php
declare(strict_types=1);

use Database\MyPdo;
use Html\AppWebPage;

MyPDO::setConfiguration('mysql:host=mysql;dbname=jacq0223;charset=utf8', 'jacq0223', 'jacq0223');

$webPage = new AppWebPage('Movies');

$sql =
    <<<'SQL'
    SELECT *
    FROM jacq0223.movie
    SQL;

$stmt = MyPdo::getInstance()->prepare($sql);


$stmt->execute();
$html = '';
while (($ligne = $stmt->fetch()) !== false) {
    $html.= "<div>";
    $title= $webPage->escapeString("{$ligne['title']}"."</div>");
    //echo $html;

    $movieId = $ligne;
    $sql =
        <<<'SQL'
        SELECT jpeg
        FROM jacq0223.image
        WHERE id= 
        SQL;
        $sql .= "{$ligne['posterId']}";


    $stmtPoster = MyPdo::getInstance()->prepare($sql);
    $stmtPoster->execute();
    while (($jpeg = $stmtPoster->fetch()) !== false){
        $html.= $jpeg['jpeg'];
    }



    $html.= "<p>".$title."</p></div>";

}
$webPage->appendContent($html);

echo $webPage->toHTML();

