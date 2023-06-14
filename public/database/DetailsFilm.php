<?php
declare(strict_types=1);

require_once '../../vendor/autoload.php';

use Database\MyPdo;
use Entity\Actor;
use Entity\Image;
use Entity\Movie;
use Entity\Cast;
use Html\MovieWebPage;

#MyPDO::setConfiguration('mysql:host=mysql;dbname=jacq0223;charset=utf8', 'jacq0223', 'jacq0223');




if (!isset($_GET["movieId"]) || !ctype_digit($_GET["movieId"])) {
    header("Location: FilmList.php");
    exit(404);
}

try {
    $film = Movie::findById((int)$_GET['movieId']);
} catch (\Entity\Exception\EntityNotFoundException) {
    header("Location: ListeFilm.php");
    http_response_code(404);
    exit(404);
}

$moviePage = new MovieWebPage();

$moviePage->setTitle("Films - {$film->getTitle()}");

$moviePage->appendContent("<img src='ImageMovie.php?imageId={$film->getPosterId()}'>");
$content =
    <<<'HTML'
     <div>
     HTML;
$content .= "<p>{$film->getTitle()}</p>\n";
$content .="<p>{$film->getReleaseDate()}</p>";
$content .="<p>{$film->getOriginalTitle()}</p>";
$content .="<p>{$film->getTagline()}</p>";
$content .="<p>{$film->getOverview()}</p>";
$content .="</div>";

$moviePage->appendContent($content);
$content .="<hr>";
#boucle acteur
$acteurs= $film->findActorByMovieId();
$content = "";
foreach($acteurs as $acteur){
    $content .= $acteur -> getContent($film->getId());
}
$moviePage->appendContent($content);

echo $moviePage->toHTML();

