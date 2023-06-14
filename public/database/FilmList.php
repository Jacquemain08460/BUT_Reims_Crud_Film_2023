<?php

declare(strict_types=1);

require_once '../../vendor/autoload.php';

use Database\MyPdo;
use Entity\Collection\MovieCollection;
use Entity\Genre;
use Entity\Movie;
use Entity\Image;
use Html\MovieWebPage;

#MyPDO::setConfiguration('mysql:host=mysql;dbname=jacq0223;charset=utf8', 'jacq0223', 'jacq0223');

$WebPage = new MovieWebPage('Movies');

$genres = Genre::getAll();


$MOVIES =MovieCollection::getMovies();

$_POST["genreId"]="";
$WebPage->appendContent("<form name='select' method='POST' action='TrieFilm.php?genreId={$_POST["genreId"]}'>");
$WebPage->appendContent("<select name='genreId'>");
foreach($genres as $genre) {
    $WebPage->appendContent(<<<HTML
                                        <option value={$genre->getId()}>{$genre->getName()}</option>
                               HTML);
}
$WebPage->appendContent(<<<HTML
                                        <option value={}>Tous</option>
                               HTML);
$WebPage->appendContent("</select>");
$WebPage->appendContent("<input type='submit' value='Submit' /></form>");

foreach ($MOVIES as $Movie) {
    $WebPage->appendContent("<a href='DetailsFilm.php?movieId={$Movie->getId()}'><img src='ImageMovie.php?imageId={$Movie->getPosterId()}'>");
    $WebPage->appendContent("{$WebPage -> escapeString($Movie -> getTitle())}</a><hr>");
}

echo $WebPage->toHTML();
