<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Entity\Actor;
use Html\AppWebPage;
use Entity\All;

#MyPDO::setConfiguration('mysql:host=mysql;dbname=cutron01_music;charset=utf8', 'web', 'web');

$All = new All\AllActors();

#$All = Actor::getAll();

$WebPage = new AppWebPage('Artistes');

$Actors = $All -> getAll();

#var_dump($Actors);

foreach ($Actors as $Actor) {
    #echo(gettype($Actor));
    #var_dump($Actor);
    #echo($Actor->getName());
    $WebPage->appendContent("<a href='actor.php?actorId={$Actor->getId()}&artistName={$Actor->getName()}'>{$WebPage -> escapeString($Actor -> getName())}</a><hr>");
}

echo $WebPage->toHTML();
