<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

use function PHPUnit\Framework\throwException;

class Image
{
    private string $jpeg;
    private int $id;

    /**
     * Accesseur de l'id de l'instance d'image
     * @return int id de l'instance
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur du jpeg de l'image, sous forme de chaîne de caractères contenant
     * le code jpeg de l'image.
     * @return string code jpeg de l'image
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * Méthode d'instance permettant de trouver une image dans la base de données
     * grâce à son id, et la renvoie en instance
     * @param int $id Id de l'image
     * @return Image Instance de l'image
     */
    public static function findById(int $id): Image
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT  id, jpeg
                FROM    image
                WHERE   id = :ID
            SQL
        );
        $stmt->execute([":ID" => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Image::class);
        $res = $stmt->fetchAll();
        if (count($res) == 0) {
            throw new EntityNotFoundException();
        }
        return $res[0];
    }
}
