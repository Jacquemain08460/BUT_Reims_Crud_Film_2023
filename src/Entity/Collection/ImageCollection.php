<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Image;
use Entity\Movie;
use PDO;

class ImageCollection
{
    /**
     * Liste toutes les images de la base de données.
     * @return array liste des images de la base de données
     */
    public static function getAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT *
                FROM image
                ORDER BY id
            SQL
        );
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Image::class);
        return $stmt->fetchAll();
    }
}