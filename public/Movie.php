<?php
declare(strict_types=1);

use Database\MyPdo;
use Entity\Movie;
use Entity\Image;
use Html\AppWebPage;

$webPage = new AppWebPage('Movies');

$sql =
    <<<'SQL'
    SELECT *
    FROM   movie
    SQL;

$stmt = MyPdo::getInstance()->prepare($sql);

$stmt->execute();

$page = new AppWebPage('Movies');



    $movieId = $ligne;
    $image = Image::findById($ligne['posterId']);

    $html.= "<img src ={$image->show()} alt='HTML5 Icon' style='width:128px;height:128px'>";



    $html.= "<p>".$title."</p></div>";

}
$webPage->appendContent($html);

echo $webPage->toHTML();

