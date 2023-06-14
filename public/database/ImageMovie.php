<?php

declare(strict_types=1);

use Database\MyPdo;
use Entity\Image;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

#MyPDO::setConfiguration('mysql:host=mysql;dbname=jacq0223;charset=utf8', 'jacq0223', 'jacq0223');


try {
    header('Content-Type: image/jpeg');
    if (!isset($_GET['imageId']) || !ctype_digit($_GET['imageId'])) {
        readfile("defaultMovie.png");
        #throw new ParameterException("The GET parameter 'imageId' is not present or is not compatible");
    } else {
        $Instance = Image::findById((int)$_GET['imageId']);
        echo $Instance -> getJpeg();
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
