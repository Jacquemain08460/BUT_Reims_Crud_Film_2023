<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Entity\Movie;
use Html\MovieWebPage;

$WebPage = new MovieWebPage('Accueil du site de Fay0026 et Jacq0223');

$WebPage -> appendContent("<a href='admin\movie-form.php'> Direction le formulaire !<a><hr>");
$WebPage -> appendContent("<a href='database\FilmList.php'> Direction la base de données !<a><hr>");

echo $WebPage->toHTML();
