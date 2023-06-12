<?php
declare(strict_types=1);

use Database\MyPdo;
use Html\AppWebPage;

MyPDO::setConfiguration('mysql:host=mysql;dbname=jacq0223;charset=utf8', 'jacq0223', 'jacq0223');

$webPage = new AppWebPage('Movies');



$sql =
    <<<'SQL'
    SELECT title
    FROM jacq0223.movie
    SQL;

$stmt = MyPdo::getInstance()->prepare($sql);

$stmt->execute();
$html = '';
while (($ligne = $stmt->fetch()) !== false) {
    $html.= "<p>";
    $html.= $webPage->escapeString("{$ligne['title']}");
    //echo $html;
}
$webPage->appendContent($html);

echo $webPage->toHTML();

