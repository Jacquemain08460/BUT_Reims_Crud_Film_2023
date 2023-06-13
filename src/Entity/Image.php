<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Image
{
    private string $jpeg;
    private int $imageId;

    public function findByIdPoster(int $idPoster):Image
    {
        $image = "";
        $sql =
            <<<'SQL'
            SELECT id, jpeg
            FROM jacq0223.image
            WHERE id = 
            SQL;
        $sql.= "{$idPoster}\n";
        $req = MyPDO::getInstance()->prepare($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, Image::class);
        $req->execute();
        foreach ($req->fetchAll() as $ligne) {
            $image=$ligne;
        }
        return $image;

    }



}