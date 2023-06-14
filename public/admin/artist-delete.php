<?php

declare(strict_types=1);

use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Html\MovieWebPage;
use Html\Form\ArtistForm;

try {
    if (isset($_GET['movieId'])) {
        if (!ctype_digit($_GET['movieId'])) {
            throw new ParameterException("Le paramètre 'movieId' n'est apparement pas un entier.");
        } else {
            $Movie = Movie::findById($_GET['movieId']);
        }
    }
    $Movie -> delete();
    header("Location: index.php");
    exit();
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}