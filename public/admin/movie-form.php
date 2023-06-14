<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Entity\Movie;
use Html\Form\ArtistForm;
use Html\Form\MovieForm;
use Html\MovieWebPage;

$PageForm = new MovieWebPage('Page de Formulaire');

$Movie = null;

try {
    if (isset($_GET['movieId'])) {
        if (!ctype_digit($_GET['movieId'])) {
            throw new ParameterException("Le paramètre 'movieId' n'est apparement pas un entier.");
        } else {
            $Movie = Movie::findById($_GET['movieId']);
        }
    }
    $MovieForm = new MovieForm($Movie);
    $PageForm->appendContent($MovieForm->getHtmlForm("movie-save.php"));
    echo $PageForm->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
