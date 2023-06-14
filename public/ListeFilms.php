<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Entity\Movie;
use Entity\Image;
use Html\MovieWebPage;

#MyPDO::setConfiguration('mysql:host=mysql;dbname=cutron01_music;charset=utf8', 'web', 'web');

#$All = new All\AllActors();

#$All = Actor::getAll();

#$WebPage = new MovieWebPage('Artistes');

#$Actors = $All -> getAll();

#var_dump($Actors);

#foreach ($Actors as $Actor) {
#echo(gettype($Actor));
#var_dump($Actor);
#echo($Actor->getName());
#$WebPage->appendContent("<a href='actor.php?actorId={$Actor->getId()}&artistName={$Actor->getName()}'>{$WebPage -> escapeString($Actor -> getName())}</a><hr>");
#}

$All = Movie::getAll();

$WebPage = new MovieWebPage('Movies');

foreach ($All as $Movie) {
    #echo(gettype($Movie));
    #var_dump($Movie);
    $WebPage->appendContent("<a href='DetailsFilm.php?movieId={$Movie->getId()}'><img src='Image.php?imageId={$Movie->getPosterId()}'>");
    $WebPage->appendContent("{$WebPage -> escapeString($Movie -> getTitle())}</a><hr>");
}

echo $WebPage->toHTML();