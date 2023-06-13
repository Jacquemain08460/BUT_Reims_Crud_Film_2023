<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Entity\Movie;
use Entity\Image;
use Html\AppWebPage;

$All = Movie::getAll();

$WebPage = new AppWebPage('Movies');

foreach ($All as $Movie) {
    #echo(gettype($Movie));
    #var_dump($Movie);
    $WebPage->appendContent("<a href='actor.php?movieId={$Movie->getmovieId()}'>{Image::get}{$WebPage -> escapeString($Movie -> getTitle())}</a><hr>");
}

echo $WebPage->toHTML();
