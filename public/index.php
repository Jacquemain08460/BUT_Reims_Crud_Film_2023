<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\AppWebPage;
use Entity\Actor;

#MyPDO::setConfiguration('mysql:host=mysql;dbname=cutron01_music;charset=utf8', 'web', 'web');

#$All = new \Entity\All\AllActors();

$All = Actor::getAll();

$WebPage = new AppWebPage('Artistes');

#$Actors = $All -> getAll();

foreach ($All as $Actor) {
    echo($Actor->getActorId());
    #$WebPage->appendContent("<a href='actor.php?actorId={$Actor->getActorId()}&artistName={$Actor->getName()}'>{$WebPage -> escapeString($Actor -> getname())}</a><hr>");
}

echo $WebPage->toHTML();
