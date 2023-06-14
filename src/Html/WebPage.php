<?php

namespace Html;

class WebPage
{
    use StringEscaper;
    private string $head;
    private string $title;
    private string $body;

    /***
     * Constructeur de la classe WebPage, prends en paramètres
     * un titre, et retourne une instance de WebPage.
     * Le titre ne devra pas être formaté.
     *
     * @param string $title Titre de la page web
     */
    public function __construct(string $title = '', string $head = '', string $body = '')
    {
        $this->title = $title;
        $this->head = $head;
        $this->body = $body;
    }

    /***
     * Méthode permettant d'ajouter du contenu dans
     * le body de la page web.
     * Prenez en compte le fait que votre contenu ne sera inséré
     * que dans une balise <body>, le reste devra être
     * écris au préalable.
     *
     * @param string $content Contenu du corps de la page web
     */
    public function appendContent(string $content)
    {
        $this->body .= $content;
    }

    /***
     * Méthode permettant d'ajouter du contenu css
     * dans le head de la page web.
     * Prenez en compte le fait que votre contenu sera insérer
     * dans la balise <head>, puis <style>
     * le reste devra être écris au préalable.
     *
     * @param string $css Contenu du css de la page web
     */
    public function appendCss(string $css)
    {
        $this->head .= '<style>' . $css . '</style>';
    }

    /***
     * Méthode permettant d'ajouter un lien css
     * dans le head de la page web.
     * Prenez en compte le fait que votre contenu sera insérer
     * dans la balise <head>, puis <link href="">
     * Vous n'aurez qu'à insérer l'url, mais vous
     * ne pouvez pas en insérer plus d'un à la fois.
     *
     * @param string $url Lien css de la page web
     */
    public function appendCssUrl(string $url)
    {
        $this->head .= '<link href="' . $url . '" rel="stylesheet">';
    }

    /***
     * Méthode permettant d'ajouter du javascript dans
     * le head de la page web.
     * Prenez en compte le fait que votre contenu sera insérer
     * dans une balise <script>
     * Mais le reste devra être écris au préalable.
     *
     * @param string $content Contenu javascript de la page web
     */
    public function appendJs(string $js)
    {
        $this->head .= '<script>' . $js . '</script>';
    }

    /***
     * Méthode permettant d'ajouter un lien javascript
     * dans le head de la page web.
     * Prenez en compte le fait que votre contenu sera insérer
     * dans la balise <head>, puis <script src=>
     * Vous n'aurez qu'à insérer l'url, mais vous
     * ne pouvez pas en insérer plus d'un à la fois.
     *
     * @param string $url Lien javascript de la page web
     */
    public function appendJsUrl(string $url)
    {
        $this->head .= '<script src="' . $url . '"></script>';
    }

    /***
     * Méthode permettant d'ajouter du contenu dans
     * le head de la page web.
     * Prenez en compte le fait que votre contenu sera insérer
     * dans une balise <head>, mais le reste devra être
     * écris au préalable.
     *
     * @param string $content Contenu de la tête de la page web
     */
    public function appendToHead(string $content)
    {
        $this->head .= $content;
    }

    /***
     * Accesseur du body de la page html sous
     * forme de chaîne de caractères.
     *
     * @return string corps de la page web
     */
    public function getBody()
    {
        return $this->body;
    }

    /***
     * Accesseur du head de la page html sous
     * forme de chaîne de caractères.
     *
     * @return string tête de la page web
     */
    public function getHead()
    {
        return $this->head;
    }

    /***
     * Accesseur du titre de la page html sous
     * forme de chaîne de caractères.
     *
     * @return string titre de la page web
     */
    public function getTitle()
    {
        return $this->title;
    }

    /***
     * Modificateur du titre de la page html, prenant
     * en paramètre une chaîne de caractères non formatée.
     *
     * @param string $title Titre de la page html
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /***
     * Méthode permettant d'obtenir la date de
     * dernière modification de l'instance.
     *
     * @return false|string Date de dernière modification
     */
    public function getLastModification()
    {
        return date("j/m/Y-h:i:s", getlastmod());
    }

    /***
     * Méthode la plus importante de la classe WebPage.
     * Permet de tansformer l'instance WebPage en code de
     * page HTML, voici les conditions :
     * Le haut de page est déjà créé
     * dans <head> sera inséré :
     * -<titre> avec le titre de l'instance
     * -la tête de l'instance
     * dans <body> sera inséré le corps de l'instance
     *
     * @return string Code HTML complet
     */
    public function toHTML()
    {
        $html = <<<HTML
                    <!DOCTYPE html>
                    <html lang="fr">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1" />
                            <title>{$this->getTitle()}</title>
                            {$this->getHead()}
                        </head>
                        <body>
                            {$this->getBody()}
                        </body>
                    </html>
                    HTML;
        return $html;
    }
}
