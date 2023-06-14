<?php
declare(strict_types=1);

use Database\MyPdo;
use Entity\Actor;
use Entity\Image;
use Entity\Movie;
use Entity\Cast;
use Html\AppWebPage;

#MyPDO::setConfiguration('mysql:host=mysql;dbname=jacq0223;charset=utf8', 'jacq0223', 'jacq0223');

if (!isset($_GET["movieId"]) || !ctype_digit($_GET["movieId"])) {
    header("Location: DetailsFilm.php");
    exit(404);
}

try {
    $film = Movie::findById((int)$_GET['movieId']);
} catch (\Entity\Exception\EntityNotFoundException) {
    header("Location: DetailsFilm.php");
    http_response_code(404);
    exit(404);
}

$moviePage = new AppWebPage();

$moviePage->setTitle("Films - {$film->getTitle()}");

$moviePage->appendContent("<img src='Image.php?imageId={$film->getPosterId()}'>");
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
    #var_dump($acteur);
    #$acteur = Actor::findById($acteur->getActorId());
    $content .= "<div>";
    #$contenu .="<a href='actor.php?actorId={$acteur->getActorId()}'>";
    $content .="<img src='Image.php?imageId={$acteur->getAvatarId()}'>";
    #$contenu .="<p>{Cast::findActorRole($acteur->getActorId())}</p>";
    $content .="<a href='DetailsActor.php?actorId={$acteur->getId()}'>{$acteur->getname()}</a><hr></div>";
}
$moviePage->appendContent($content);

echo $moviePage->toHTML();

