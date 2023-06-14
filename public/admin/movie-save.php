<?php

declare(strict_types=1);

use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Html\MovieWebPage;
use Html\Form\ArtistForm;

try {
    $Movie = new MovieForm();
    $Movie -> setEntityFromQueryString();
    $Movie -> save();
    header("Location: index.php");
    exit();
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
