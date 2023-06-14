<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Cast;
use Entity\Movie;
use PDO;

class CastCollection
{
    /**
     * Liste tous les castind de la base de données.
     * @return array liste de tous les casting
     */
    public static function getAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT *
                FROM cast
                ORDER BY id
            SQL
        );
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Cast::class);
        return $stmt->fetchAll();
    }
}