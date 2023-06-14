<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Actor;
use PDO;

class ActorCollection
{
    /**
     * Méthode de classe renvoyant une liste de tout les acteurs présents dans la base de donnée.
     * @return Actor[] liste d'acteurs
     */
    public static function getAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT id, name
                FROM people
                ORDER BY name
            SQL
        );
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Actor::class);
        return $stmt->fetchAll();
    }

}