<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\All\AllActors;

#use Entity\Exception;

use Entity\Exception\EntityNotFoundException;
use PDO;

#use function PHPUnit\Framework\throwException;

class Actor
{
    private int $actorid;
    private string $name;
    private string|null $birthday;
    private string|null $deathday;
    private string|null $birthplace;
    private string|null $biography;
    private int|null $avatarid;
    private int $id;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Actor
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getActorId(): ?int
    {
        return $this->actorid;
    }

    /**
     * @param int|null $id
     * @return Actor
     */
    private function setActorId(?int $id): void
    {
        $this->actorid = $id;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string|null
     */
    public function getDeathday(): ?string
    {
        return $this->deathday;
    }

    /**
     * @param string|null $deathday
     */
    public function setDeathday(string $deathday): void
    {
        $this->deathday = $deathday;
    }

    /**
     * @return string
     */
    public function getBirthplace(): string
    {
        return $this->birthplace;
    }

    /**
     * @param string $birthplace
     */
    public function setBirthplace(string $birthplace): void
    {
        $this->birthplace = $birthplace;
    }

    /**
     * @return string|null
     */
    public function getBiography(): ?string
    {
        return $this->biography;
    }

    /**
     * @param string $biography
     * @return Actor
     */
    public function setBiography(string $biography): void
    {
        $this->biography = $biography;
    }

    /**
     * @return string
     */
    public function getAvatarid(): int
    {
        return $this->avatarid;
    }

    /**
     * @param string $avatarid
     */
    public function setAvatarid(int $avatarid): void
    {
        $this->avatarid = $avatarid;
    }

    public function delete():void
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                DELETE FROM ACTOR
                WHERE ID = :ID
    SQL
        );
        $stmt->execute([":ID" => $this->actorid]);
    }

    public function update():void
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                UPDATE  ACTOR
                SET     name = :NAME
                WHERE   ID = :ID
    SQL
        );
        $stmt->execute([":ID" => $this->actorid, ":NAME" => $this->name]);
    }

    public function insert():void
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                INSERT  INTO ACTOR (name)
                VALUES  (:NAME)
    SQL
        );
        $stmt->execute([":NAME" => $this->name]);
        $this->actorid = (int)MyPDO::getInstance()->lastInsertId();
    }

    public function save():void
    {
        if ($this->actorid == null) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public static function create($name, $id = null):void
    {
        $actor = new Actor();
        $actor->setName($name);
        $actor->setId($id);
    }

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

    public static function findById(int $id): Actor
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT  *
                FROM    people
                WHERE   id = :Id
            SQL
        );
        $stmt->execute([":Id" => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Actor::class);
        $res = $stmt->fetchAll();
        if (count($res) == 0) {
            throw new EntityNotFoundException();
        }
        return $res[0];
    }
}