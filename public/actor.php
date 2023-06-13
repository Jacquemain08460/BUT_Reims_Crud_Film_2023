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
    echo('HAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
    header("Location: index.php");
    http_response_code(404);
    exit(404);
}

$ActorPage = new AppWebPage();

$ActorPage->setTitle("Films - {$actor->getName()}");

echo $ActorPage->toHTML();
