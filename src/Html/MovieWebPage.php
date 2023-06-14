<?php

declare(strict_types=1);

namespace Html;

class MovieWebPage extends WebPage
{
    public function __construct(string $title = '', string $head = '', string $body = '')
    {
        parent::__construct($title, $head, $body);
    }

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
