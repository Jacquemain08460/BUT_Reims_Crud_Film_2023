<?php

declare(strict_types=1);

namespace Entity;

class MovieForm extends Movie
{
    public movie $movie;

    /**
     * @param ?movie $movie
     */
    public function __construct(?movie $movie = null)
    {
        $this->movie = $movie;
    }

    /**
     * @return movie
     */
    public function getMovie(): movie
    {
        return $this->movie;
    }

    public function getHtmlForm(string $action): string
    {
        return <<<HTML
        <html lang="fr">
        <form action="$action" method="post">
            <input type="hidden" name="ID">
            <label for="Nom">Nom de l'artiste</label>
            <input type="text" name="Nom" required>
            <input type="submit" value="Enregistrer">
         </form>
        </html>
        HTML;
    }

}