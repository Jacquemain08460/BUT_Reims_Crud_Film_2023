<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Entity\Actor;
use Html\AppWebPage;

#MyPDO::setConfiguration('mysql:host=mysql;dbname=jacq0223;charset=utf8', 'jacq0223', 'jacq0223');

if (!isset($_GET["actorId"]) || !ctype_digit($_GET["actorId"])) {
    header("Location: index.php");
    exit(404);
}

try {
    $actor = Actor::findById((int)$_GET['actorId']);
} catch (\Entity\Exception\EntityNotFoundException) {
    header("Location: index.php");
    http_response_code(404);
    exit(404);
}

$ActorPage = new AppWebPage();

$ActorPage->setTitle("Films - {$actor->getName()}");
$ActorPage->appendContent("<img src='Image.php?imageId={$actor->getAvatarId()}'>");

$content = <<<HTML
                <div>
                    <p>{$actor->getAvatarId()}</p>
                    <p>{$actor->getBirthday()}</p>
                    <p>{$actor->getDeathday()}</p>
                    <p>{$actor->getName()}</p>
                    <p>{$actor->getBiography()}</p>
                    <p>{$actor->getPlaceOfBirth()}</p>
                    <p>{$actor->getid()}</p>
                </div>
            HTML;

$ActorPage->appendContent($content);

$Films= $actor->findMovieByActorId();
$content= "";

foreach($Films as $film) {
    #var_dump($film);
    $content .= "<div>
                    <img src='Image.php?imageId={$film->getPosterId()}'>
                    <a href='DetailsFilm.php?movieId={$film->getId()}'>{$film->getTitle()}</a><hr>
                 </div>";
}

$ActorPage->appendContent($content);

echo $ActorPage->toHTML();
