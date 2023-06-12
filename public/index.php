<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Entity\Actor;
use Html\AppWebPage;

if (!isset($_GET["artistId"]) || !ctype_digit($_GET["artistId"])) {
    header("Location: index.php");
    exit(404);
}

try {
    $artist = Artist::findById((int)$_GET['artistId']);
} catch (\Entity\Exception\EntityNotFoundException) {
    header("Location: index.php");
    http_response_code(404);
    exit(404);
}