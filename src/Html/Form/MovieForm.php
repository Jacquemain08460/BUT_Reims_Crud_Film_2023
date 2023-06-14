<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Exception\ParameterException;
use Entity\Movie;
use Html;

class MovieForm
{
    use Html\StringEscaper;
    private ?Movie $Movie;

    /**
     * @param Movie|null $NewMovie
     */
    public function __construct(?movie $NewMovie = null)
    {
        $this->Movie = $NewMovie;
    }

    /**
     * @return Movie|null
     */
    public function getMovie(): ?movie
    {
        return $this->Movie;
    }

    /**
     * $PI, $OL, $OT, $OV, $RD, $RT, $TG, $TT, $ID
     * @param Movie|null $New
     * @return MovieForm
     */
    public function setMovie(?Movie $New): MovieForm
    {
        $this -> Movie -> setId($New->getId());
        $this -> Movie -> setPosterId($New->getPosterId());
        $this -> Movie -> setOriginalLanguage($New->getOriginalLanguage());
        $this -> Movie -> setOriginalTitle($New->getOriginalTitle());
        $this -> Movie -> setOverview($New->getOverview());
        $this -> Movie -> setReleaseDate($New->getReleaseDate());
        $this -> Movie -> setRuntime($New->getRuntime());
        $this -> Movie -> setTagline($New->getTagline());
        $this -> Movie -> setTitle($New->getTitle());
        return $this;
    }

    public function getHtmlForm(string $action): string
    {
        if (ctype_digit($this?->Movie?->getId())) {
            $NewId = $this?->Movie?->getId();
        } else {
            $NewId = null;
        }
        return <<<HTML
        <html lang="fr">
        <form action="$action" method="post">
            <input type="hidden" name="ID" value="{$NewId}">
            <label for="Nom">Id du poster du film</label>
            <input type="text" name="PI" value="{$this?->escapeString($this?->Movie?->getPosterId())}"><br>
            <label for="Nom">Langue originale du film</label>
            <input type="text" name="OL" value="{$this?->escapeString($this?->Movie?->getOriginalLanguage())}" required><br>
            <label for="Nom">Titre original du film</label>
            <input type="text" name="OT" value="{$this?->escapeString($this?->Movie?->getOriginalTitle())}" required><br>
            <label for="Nom">Résumé du film</label>
            <input type="text" name="OV" value="{$this?->escapeString($this?->Movie?->getOverview())}" required><br>
            <label for="Nom">Date de sortie du film</label>
            <input type="text" name="RD" value="{$this?->escapeString($this?->Movie?->getReleaseDate())}" required><br>
            <label for="Nom">Durée du film</label>
            <input type="text" name="RT" value="{$this?->escapeString($this?->Movie?->getRuntime())}" required><br>
            <label for="Nom">Slogan du film</label>
            <input type="text" name="TG" value="{$this?->escapeString($this?->Movie?->getTagline())}" required><br>
            <label for="Nom">Titre du film</label>
            <input type="text" name="TT" value="{$this?->escapeString($this?->Movie?->getTitle())}" required><br>
            <input type="submit" value="Enregistrer">
         </form>
        </html>
        HTML;
    }

    /**
     * @throws ParameterException
     */
    public function setEntityFromQueryString(): void
    {
        $PI = null;
        $ID = null;
        if (isset($_POST['PI']) && ctype_digit($_POST['PI'])) {
            $PI = (int)$_POST['PI'];
        }
        if (isset($_POST['OL'])) {
            $OL = $this->stripTagsAndTrim($this->escapeString($_POST['OL']));
        } else {
            throw new ParameterException();
        }
        if (isset($_POST['OT'])) {
            $OT = $this->stripTagsAndTrim($this->escapeString($_POST['OT']));
        } else {
            throw new ParameterException();
        }
        if (isset($_POST['OV'])) {
            $OV = $this->stripTagsAndTrim($this->escapeString($_POST['OV']));
        } else {
            throw new ParameterException();
        }
        if (isset($_POST['RD'])) {
            $RD = $this->stripTagsAndTrim($this->escapeString($_POST['RD']));
        } else {
            throw new ParameterException();
        }
        if (isset($_POST['RT']) && ctype_digit($_POST['RT'])) {
            $RT = (int)$_POST['RT'];
        } else {
            throw new ParameterException();
        }
        if (isset($_POST['TG'])) {
            $TG = $this->stripTagsAndTrim($this->escapeString($_POST['TG']));
        } else {
            throw new ParameterException();
        }
        if (isset($_POST['TT'])) {
            $TT = $this->stripTagsAndTrim($this->escapeString($_POST['TT']));
        } else {
            throw new ParameterException();
        }
        if (isset($_POST['ID']) && ctype_digit($_POST['ID'])) {
            $ID = (int)$_POST['ID'];
        }
        $Art = Movie::create($PI, $OL, $OT, $OV, $RD, $RT, $TG, $TT, $ID);
        #A movie is a piece of art, right ?
        $this -> Movie = $Art;
    }

    /**
     * Fonction permettant de demander à l'instance de se sauvegarder
     * @return Void
     */
    public function goSave(): Void
    {
        $this -> Movie -> save();
    }
}
