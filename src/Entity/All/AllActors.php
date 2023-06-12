<?php

declare(strict_types=1);

namespace Entity\All;

use Database\MyPdo;
use Entity\Actor;
use PDO;

class AllActors
{
    /**
     * Cette méthode permet la récupération automatique
     * d'une liste de tout les artistes disponibles dans
     * la base.
     * @return Actor[]
     */
    public function getAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT *
                FROM people
                ORDER BY name
            SQL
        );
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Actor::class);
        return $stmt->fetchAll();
    }

    public static function findWithMovie(int $MovieId): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT *
                FROM album
                WHERE Id = :id
                ORDER BY name
            SQL
        );
        $stmt->execute([":id" => $MovieId]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Actor::class);
        return $stmt->fetchAll();
    }
}
