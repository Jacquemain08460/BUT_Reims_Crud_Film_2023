<?php
declare(strict_types=1);

use Database\MyPdo;
use Entity\Image;
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
    $image = Image::findById($ligne['posterId']);

    $html.= "<img src ={$image->show()} alt='HTML5 Icon' style='width:128px;height:128px'>";



    $html.= "<p>".$title."</p></div>";

}
$webPage->appendContent($html);

echo $webPage->toHTML();

