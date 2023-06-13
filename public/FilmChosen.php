<?php
declare(strict_types=1);

use Database\MyPdo;
use Entity\Image;
use Entity\Movie;
use Html\AppWebPage;

MyPDO::setConfiguration('mysql:host=mysql;dbname=jacq0223;charset=utf8', 'jacq0223', 'jacq0223');

if (!isset($_GET["movieId"]) || !ctype_digit($_GET["movieId"])) {
    header("Location: Film.php");
    exit(404);
}

try {
    $film = Movie::findById((int)$_GET['movieId']);
} catch (\Entity\Exception\EntityNotFoundException) {
    echo('HAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
    header("Location: Movie.php");
    http_response_code(404);
    exit(404);
}

$moviePage = new AppWebPage();

$moviePage->setTitle("Films - {$film->getTitle()}");

$contenu =
    <<<'HTML'
     <div>
     <img scr="" >
     HTML;
$contenu .= "<p>{$film->getTitle()}</p>\n";
$contenu .="<p>{$film->getReleaseDate()}</p>";
$contenu .="<p>{$film->getOriginalTitle()}</p>";
$contenu .="<p>{$film->getTagline()}</p>";
$contenu .="<p>{$film->getOverview()}</p>";
$contenu .="</div>";

$moviePage->appendContent($contenu);
#boucle acteur

echo $moviePage->toHTML();
