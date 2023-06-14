<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Entity\Movie;
use Html\MovieWebPage;

$Form = <<<HTML
         <form action="$action" method="post">
            <input type="hidden" name="ID">
            <label for="Nom">Nom de l'artiste</label>
            <input type="text" name="Nom" required>
            <input type="submit" value="Enregistrer">
         </form>
         HTML;

$WebPage = new MovieWebPage('Movies');

$WebPage -> appendContent($Form);

echo $WebPage->toHTML();
