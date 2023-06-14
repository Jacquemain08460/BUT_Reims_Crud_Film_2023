<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use PDO;

class GenreCollection
{
    /**
     * Liste tous les genres de la base de données.
     * @return array liste des genres de la base de données
     */
    public static function getAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT *
                FROM genre
                ORDER BY id
            SQL
        );
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Genre::class);
        return $stmt->fetchAll();
    }
}