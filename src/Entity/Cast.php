<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Cast
{
    private int $movieId;
    private int $peopleId;
    private string $role;
    private int $orderIndex;
    private int $castId;

    /**
     *
     */
    public static function findActorRole(int $ID):?string
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT  role
                FROM    cast
                WHERE   peopleId = :Id
            SQL
        );
        $stmt->execute([":Id" => $ID]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Cast::class);
        $res = $stmt->fetchAll();
        if (count($res) == 0) {
            throw new EntityNotFoundException();
        }
        return $res['role'];
    }
}