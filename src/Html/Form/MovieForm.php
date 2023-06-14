<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Movie;
use Entity\Exception\ParameterException;
use Html;

class MovieForm extends Movie
{
    use Html\StringEscaper;

    public movie|null $movie;

    /**
     * @param ?Movie $movie
     */
    public function __construct(?movie $NewMovie = null)
    {
        $this->movie = $NewMovie;
    }

    /**
     * @return Movie|null
     */
    public function getMovie(): ?movie
    {
        return $this->movie;
    }

    public function getHtmlForm(string $action): string
    {
        return <<<HTML
        <html lang="fr">
        <form action="$action" method="post">
            <input type="hidden" name="ID" value="{$this?->movie?->getId()}">
            <label for="Nom">Id du poster du film</label>
            <input type="text" name="PI" value="{$this?->escapeString($this?->movie?->getTitle())}"><br>
            <label for="Nom">Langue originale du film</label>
            <input type="text" name="OL" value="{$this?->escapeString($this?->movie?->getTitle())}"><br>
            <label for="Nom">Titre original du film</label>
            <input type="text" name="OT" value="{$this?->escapeString($this?->movie?->getTitle())}"><br>
            <label for="Nom">Résumé du film</label>
            <input type="text" name="OV" value="{$this?->escapeString($this?->movie?->getTitle())}"><br>
            <label for="Nom">Date de sortie du film</label>
            <input type="text" name="RD" value="{$this?->escapeString($this?->movie?->getTitle())}"><br>
            <label for="Nom">Durée du film</label>
            <input type="text" name="RT" value="{$this?->escapeString($this?->movie?->getTitle())}"><br>
            <label for="Nom">Slogan du film</label>
            <input type="text" name="TG" value="{$this?->escapeString($this?->movie?->getTitle())}"><br>
            <label for="Nom">Titre du film</label>
            <input type="text" name="TT" value="{$this?->escapeString($this?->movie?->getTitle())}" required><br>
            <input type="submit" value="Enregistrer">
         </form>
        </html>
        HTML;
    }

    /**
     * @throws ParameterException
     */
    public function setEntityFromQueryString(): Void
    {
        $PI = null;
        $OL = null;
        $OT = null;
        $OV = null;
        $RD = null;
        $RT = null;
        $TG = null;
        $ID = null;
        if (isset($_POST['PI']) && ctype_digit($_POST['PI'])) {
            $PI = (int)$_POST['PI'];
        }
        if (isset($_POST['OL'])) {
            $OL = (string)$_POST['OL'];
        }
        if (isset($_POST['OT'])) {
            $OT = (string)$_POST['OT'];
        }
        if (isset($_POST['OV'])) {
            $OV = (string)$_POST['OV'];
        }
        if (isset($_POST['RD'])) {
            $RD = (string)$_POST['RD'];
        }
        if (isset($_POST['RT']) && ctype_digit($_POST['RT'])) {
            $RT = (int)$_POST['RT'];
        }
        if (isset($_POST['TG'])) {
            $TG = (string)$_POST['TG'];
        }
        if (isset($_POST['TT']) && $_POST['TT']!="") {
            $TT = $this->stripTagsAndTrim($this->escapeString($_POST['TT']));
        } else {
            throw new ParameterException();
        }
        if (isset($_POST['ID']) && ctype_digit($_POST['ID'])) {
            $ID = (int)$_POST['ID'];
        }
        $Art = Movie::create($PI, $OL, $OT, $OV, $RD, $RT, $TG, $TT, $ID);
        #A movie is a piece of art, right ?
        $this->movie = $Art;
    }
}
