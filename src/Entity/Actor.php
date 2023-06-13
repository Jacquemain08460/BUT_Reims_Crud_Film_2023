<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\All\AllActors;

#use Entity\Exception;

use PDO;

#use function PHPUnit\Framework\throwException;

class Actor
{
    private int $actorid;
    private string $name;
    private string $birthday;
    private string|null $deathday;
    private string $birthplace;
    private string $biography;
    private string $avatarid;
    private string $id;

    private function __construct()
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Actor
     */
    public function setId(string $id): Actor
    {
        $this->id = $id;
        return $this;
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
     * @return Artist
     */
    public function setName(string $name): Artist
    {
        $this->name = $name;
        return $this;
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
     * @return Artist
     */
    private function setActorId(?int $id): Artist
    {
        $this->actorid = $id;
        return $this;
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
     * @return Actor
     */
    public function setBirthday(string $birthday): Actor
    {
        $this->birthday = $birthday;
        return $this;
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
     * @return Actor
     */
    public function setDeathday(?string $deathday): Actor
    {
        $this->deathday = $deathday;
        return $this;
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
     * @return Actor
     */
    public function setBirthplace(string $birthplace): Actor
    {
        $this->birthplace = $birthplace;
        return $this;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @param string $biography
     * @return Actor
     */
    public function setBiography(string $biography): Actor
    {
        $this->biography = $biography;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatarid(): string
    {
        return $this->avatarid;
    }

    /**
     * @param string $avatarid
     * @return Actor
     */
    public function setAvatarid(string $avatarid): Actor
    {
        $this->avatarid = $avatarid;
        return $this;
    }

    public function getActorMovie(): array
    {
        return AllMovies::findbyActorId($this->actorid);
    }

    public function delete()
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                DELETE FROM ARTIST
                WHERE ID = :ID
    SQL
        );
        $stmt->execute([":ID" => $this->actorid]);
    }

    public function update()
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                UPDATE  ARTIST
                SET     name = :NAME
                WHERE   ID = :ID
    SQL
        );
        $stmt->execute([":ID" => $this->actorid, ":NAME" => $this->name]);
        return $this;
    }

    public function insert()
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                INSERT  INTO ARTIST (name)
                VALUES  (:NAME)
    SQL
        );
        $stmt->execute([":NAME" => $this->name]);
        $this->actorid = (int)MyPDO::getInstance()->lastInsertId();
        return $this;
    }

    public function save()
    {
        if ($this->actorid == null) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }

    public static function create($name, $id = null)
    {
        $artiste = new Artist();
        $artiste->setName($name);
        $artiste->setId($id);
        return $artiste;
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

    public static function findById(int $Id): Actor
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


#posterId, originalLanguage, originalTitle, overview, releaseDate, runtime, tagline, title, movieId
