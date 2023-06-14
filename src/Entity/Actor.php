<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\All\AllActors;
use Entity\Exception\EntityNotFoundException;
use PDO;

#use Entity\Exception;

#use function PHPUnit\Framework\throwException;

class Actor
{
    private int|null $avatarId;
    private string|null $birthday;
    private string|null $deathday;
    private string $name;
    private string|null $biography;
    private string|null $placeOfBirth;
    private int|null $id;


    /**
     * Accesseur de l'id d'un acteur
     * @return int l'id de l'acteur
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Modificateur de l'id d'un acteur
     * @param int $id nouvel id
     * @return Actor l'instance
     */
    public function setId(int $id): Actor
    {
        $this->id = $id;
        return $this;
    }


    /**
     * Accesseur du nom de l'acteur
     * @return string le nom
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Modificateur du nom de l'acteur
     * @param string $name nouveau nom
     * @return Actor l'instance
     */
    public function setName(string $name): Actor
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Accesseur de la date d'anniversaire de l'acteur en string
     * @return string Date d'anniversaire
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * Modificateur de la date d'anniversaire de l'acteur en string
     * @param string $birthday nouvelle date
     * @return Actor l'instance
     */
    public function setBirthday(string $birthday): Actor
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * Accesseur de la date de décès de l'acteur en string, qui peut
     * être à null
     * @return string|null Date de décès
     */
    public function getDeathday(): ?string
    {
        return $this->deathday;
    }

    /**
     * Modificateur de la date de décès de l'acteur en string
     * @param string $deathday nouvelle date de décès
     * @return Actor l'instance
     */
    public function setDeathday(string $deathday): Actor
    {
        $this->deathday = $deathday;
        return $this;
    }

    /**
     * Accesseur du lieu de naissance de l'acteur
     * @return string lieu de naissance
     */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    /**
     * Modificateur du lieu de naissance de l'acteur
     * @param string $placeOfBirth nouveau lieu de naissance
     * @return Actor l'instance
     */
    public function setPlaceOfBirth(string $placeOfBirth): Actor
    {
        $this->placeOfBirth = $placeOfBirth;
        return $this;
    }

    /**
     * Accesseur de la biographie de l'auteur, qui
     * peut être null
     * @return string|null biographie de l'auteur
     */
    public function getBiography(): ?string
    {
        return $this->biography;
    }

    /**
     * Modificateur de la biographie de l'auteur
     * @param string $biography nouvelle biographie
     * @return Actor l'instance
     */
    public function setBiography(string $biography): Actor
    {
        $this->biography = $biography;
        return $this;
    }

    /**
     * Accesseur de l'id de l'avatar (l'image/portrait) de l'auteur, qui
     * peut être null
     * @return int|null l'id de l'avatar
     */
    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }

    /**
     * Modificateur de l'id de l'avatar (l'image/portrait) de l'auteur
     * @param int|null $avatarid nouvelle id d'avatar
     * @return Actor l'instance
     */
    public function setAvatarId(?int $avatarid): Actor
    {
        $this->avatarId = $avatarid;
        return $this;
    }

    /**
     * Méthode d'instance permettant de receuillir les informations importantes d'une instance
     * d'acteur, prenant en paramètre l'id d'un film. Renvoie donc une chaîne de caractères contenant :
     * -le lien vers la page contenant les détails de l'acteur
     * -l'avatar (portrait/image) de l'acteur, grâce à un lien vers Image.php
     * -Le rôle de l'acteur dans le film
     * -Le nom de l'acteur
     * @param int $MID Id du film correspondant à la recherche
     * @return string informations de l'acteur en string
     */
    public function getContent(int $MID): string
    {
        return "<a href='DetailsActor.php?actorId={$this->getId()}'>
                <img src='Image.php?imageId={$this->getAvatarId()}'>
                <div> {$this->findActorRole($MID)->getRole()} </div>
                <div> {$this->getName()} </div>
                </a> <hr>";
    }

    /**
     * Cette méthode d'instance permet de supprimer de la base de donnée l'instance
     * d'acteur grâce à son id.
     * @return void
     */
    public function delete(): void
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                DELETE FROM ACTOR
                WHERE ID = :ID
    SQL
        );
        $stmt->execute([":ID" => $this->id]);
    }

    /**
     * Méthode d'instance permettant de mettre à jour la base de donnée grâce
     * à l'instance d'Acteur.
     * @return $this l'instance
     */
    public function update(): Actor
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                UPDATE  ACTOR
                SET     name = :NAME
                WHERE   ID = :ID
    SQL
        );
        $stmt->execute([":ID" => $this->id, ":NAME" => $this->name]);
        return $this;
    }

    /**
     * Permet d'insérer dans la base de donnée l'instance d'acteur en tant que nouvel acteur.
     * @return $this l'instance
     */
    public function insert(): Actor
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                INSERT  INTO ACTOR (name)
                VALUES  (:NAME)
    SQL
        );
        $stmt->execute([":NAME" => $this->name]);
        $this->actorid = (int)MyPDO::getInstance()->lastInsertId();
        return $this;
    }

    /**
     * Permet de sauvegarder dans la base de données les informations de l'instance d'auteur,
     * si son id n'est pas dans la base de donnée, il est ajouté avec insert(), sinon,
     * il est mis à jour avec update()
     * @return $this l'instance
     */
    public function save(): Actor
    {
        if ($this->actorid == null) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }

    /**
     * Méthode d'instance permettant de créer un nouvel auteur, prends en paramètres tout ses
     * attributs et renvoie l'acteur créé.
     * @param $name
     * @param $id
     * @return Actor l'instance créée
     */
    public static function create($name, $id = null): Actor
    {
        $actor = new Actor();
        $actor->setName($name);
        $actor->setId($id);
        return $actor;
    }

    /**
     * Méthode de classe renvoyant une liste de tout les acteurs présents dans la base de donnée.
     * @return Acteur[] liste d'acteurs
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

    /**
     * Méthode de classe permettant d'extraire un acteur de la base de donnée grâce
     * à l'id passé en paramètres.
     * @param int $id id de l'acteur voulu
     * @return Actor instance de l'acteur voulu
     */
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

    /**
     * Méthode d'instance permettant d'extraire tout les films de la base de données qui sont liés à
     * l'instance d'acteur.
     * @return Movie[] Liste de films
     */
    public function findMovieByActorId(): array
    {
        #var_dump($this);
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT  DISTINCT *
        FROM    movie
        WHERE   movie.id in (SELECT  movieId
                             FROM    cast
                             WHERE   peopleId = :ID)
        SQL
        );
        $stmt->execute([":ID" => $this->getId()]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Movie::class);
        $res = $stmt->fetchAll();
        if (count($res) == 0) {
            throw new EntityNotFoundException();
        }
        return $res;
    }

    /**
     * Méthode d'instance, qui permet à partir d'un id de film et d'une instance d'acteur, de retrouver
     * le rôle de l'acteur dans ce film.
     * @param int $MID id du film
     * @return cast rôle de l'acteur
     */
    public function findActorRole(int $MID): cast
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT  *
            FROM    cast
            WHERE   movieId  = :MID
                    AND peopleId = :PID
        SQL
        );
        #var_dump($this->id);
        #var_dump($MID);
        $stmt->execute([":PID" => $this->id, ":MID" => $MID]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Cast::class);
        $res = $stmt->fetchAll();
        #var_dump($res);
        if (count($res) == 0) {
            throw new EntityNotFoundException();
        }
        return $res[0];
    }
}
