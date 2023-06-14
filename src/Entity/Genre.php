<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Genre
{
    private string $name;
    private int $id;

    /**
     * Accesseur de l'id du genre
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur de l'attribut d'instance name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Modificateur de l'attribut d'instance name.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Acesseur de tous les genres de la base de données.
     * @return array Liste des genres
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
