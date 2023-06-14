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

$contenu =
    <<<'HTML'
     <div>
     HTML;
$contenu .= "<p>{$film->getTitle()}</p>\n";
$contenu .="<p>{$film->getReleaseDate()}</p>";
$contenu .="<p>{$film->getOriginalTitle()}</p>";
$contenu .="<p>{$film->getTagline()}</p>";
$contenu .="<p>{$film->getOverview()}</p>";
$contenu .="</div>";

$moviePage->appendContent($contenu);
$contenu .="";
#boucle acteur
$acteurs= $film->findActorByMovieId();
$contenu = "";
foreach($acteurs as $acteur){
    #var_dump($acteur);
    #$acteur = Actor::findById($acteur->getActorId());
    $contenu .= "<div>";
    #$contenu .="<a href='actor.php?actorId={$acteur->getActorId()}'>";
    $contenu .="<img src='Image.php?imageId={$acteur->getAvatarId()}'>";
    #$contenu .="<p>{Cast::findActorRole($acteur->getActorId())}</p>";
    $contenu .="<a href='DetailsActor.php?actorId={$acteur->getId()}'>{$acteur->getname()}</a><hr></div>";
}
$moviePage->appendContent($contenu);

echo $moviePage->toHTML();

