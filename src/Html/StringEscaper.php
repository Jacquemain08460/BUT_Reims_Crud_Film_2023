<?php

declare(strict_types=1);

namespace Html;

use Entity\Artist;

trait StringEscaper
{
    /***
     * Méthode permettant de convertir une chaîne de caractère
     * et de la protéger pour la passer sans soucis dans la
     * page web. Retourne la chaîne protégée.
     *
     * @param string|null $string chaîne à protéger
     * @return string chaîne protégée
     */
    public function escapeString(?string $string): string
    {
        $ret = "";
        if ($string != null) {
            $ret = htmlspecialchars($string, ENT_HTML5 | ENT_QUOTES);
        }
        return $ret;
    }

    public function stripTagsAndTrim(?string $text): string
    {
        $ret = "";
        if ($text != null) {
            $ret = strip_tags(trim($text, " \n\r\t\v\x00"));
        }
        return $ret;
    }
}