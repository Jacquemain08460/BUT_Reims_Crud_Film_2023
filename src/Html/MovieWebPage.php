<?php

declare(strict_types=1);

namespace Html;

class MovieWebPage extends WebPage
{
    public function __construct(string $title = '', string $head = '', string $body = '')
    {
        parent::__construct($title, $head, $body);
    }

    /***
     * Méthode la plus importante de la classe MovieWebPage. Permet de tansformer l'instance MovieWebPage en code de
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
                            <link rel='stylesheet' media='screen' href='css/style.css'>
                            <title>{$this->getTitle()}</title>
                            {$this->getHead()}
                        </head>
                        <body>
                            <div class="header">
                                <h1>{$this->getTitle()}</h1>
                            </div>
                            <content class="content"> 
                                <div class="list">
                                    {$this->getBody()}
                                </div>
                            </content>
                            <footer class="footer">
                                Dernière modification : {$this->getLastModification()}
                            </footer>
                        </body>
                    </html>
                    HTML;
        return $html;
    }
}
