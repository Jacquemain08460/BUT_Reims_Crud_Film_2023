<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Actor;
use Entity\Exception;
use Entity\Exception\EntityNotFoundException;
use PDO;

use function PHPUnit\Framework\throwException;

class Image
{
    private string $jpeg;
    private int $imageId;

    public function getId():int
    {
        return $this->imageId;
    }

    public function getJpeg():string
    {
        return $this->jpeg;
    }

    public static function findById(int $id):Image
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