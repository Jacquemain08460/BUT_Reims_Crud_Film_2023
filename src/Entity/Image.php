<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

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
        $image = "";
        $sql =
            <<<'SQL'
            SELECT id, jpeg
            FROM jacq0223.image
            WHERE id = 
            SQL;
        $sql.= "{$id}\n";
        $req = MyPDO::getInstance()->prepare($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, Image::class);
        $req->execute();
        foreach ($req->fetchAll() as $ligne) {
            $image=$ligne;
        }
        return $image;
    }
}