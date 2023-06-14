<?php

declare(strict_types=1);

use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Html\MovieWebPage;
use Html\Form\MovieForm;

try {
    $Form = new MovieForm();
    $Form -> setEntityFromQueryString();
    $Form -> goSave();
    header("Location: movie-form.php");
    exit();
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
