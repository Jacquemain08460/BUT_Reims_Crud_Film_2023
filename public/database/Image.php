<?php

declare(strict_types=1);

require_once '../../vendor/autoload.php';

use Entity\Image;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    if (!isset($_GET['imageId']) || !ctype_digit($_GET['imageId'])) {
        throw new ParameterException("The GET parameter 'imageId' is not present or is not compatible");
    }
    header('Content-Type: image/jpeg');
    $Instance = Image::findById((int)$_GET['imageId']);
    echo $Instance -> getJpeg();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}