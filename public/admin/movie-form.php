<?php

declare(strict_types=1);

use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Html\MovieWebPage;
use Html\Form\ArtistForm;

$PageForm = new MovieWebPage('Page de Formulaire');

$Artist = null;

try {
    if (isset($_GET['movieId'])) {
        if (!ctype_digit($_GET['movieId'])) {
            throw new ParameterException("Le paramètre 'movieId' n'est apparement pas un entier.");
        } else {
            $Actor = Movie::findById($_GET['movieId']);

            $ActorForm = new ArtistForm($Artist);

            $PageForm -> appendContent($Formulaire->getHtmlForm("movie-save.php"));

            echo $PageForm->toHTML();
        }
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
