<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Movie
{
    private int|null $posterId;
    private string $originalLanguage;
    private string $originalTitle;
    private string $overview;
    /** Date sous forme 'YYYY-MM-DD'**/
    private string $releaseDate;
    private int $runtime;
    private string $tagline;
    private string $title;
    private int|null $id;

    /**
     * Modificateur de l'attribut id.
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Accesseur de l'id de l'instance de Movie.
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Accesseur de l'attribut posterId de l'entité.
     * @return int|null
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * Modificateur de l'attribut posterId de l'entité.
     * @param int|null $posterId
     * @return Movie
     */
    public function setPosterId(?int $posterId): Movie
    {
        $this->posterId = $posterId;
        return $this;
    }

    /**
     * Accesseur de l'attribut originalLanguage de l'entité.
     * @return string
     */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /**
     * Modificateur de l'attribut originalLanguage de l'entité.
     * @param string $originalLanguage
     * @return Movie
     */
    public function setOriginalLanguage(string $originalLanguage): Movie
    {
        $this->originalLanguage = $originalLanguage;
        return $this;
    }

    /**
     * Accesseur de l'attribut originalTitle de l'entité.
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
     * Modificateur de l'attribut originalTitle de l'entité.
     * @param string $originalTitle
     * @return Movie
     */
    public function setOriginalTitle(string $originalTitle): Movie
    {
        $this->originalTitle = $originalTitle;
        return $this;
    }

    /**
     * Accesseur de l'attribut overview de l'entité.
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Modificateur de l'attribut overview de l'entité.
     * @param string $overview
     * @return Movie
     */
    public function setOverview(string $overview): Movie
    {
        $this->overview = $overview;
        return $this;
    }

    /**
     * Accesseur de l'attribut releaseDate de l'entité.
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * Modificateur de l'attribut releaseDate de l'entité.
     * @param string $releaseDate
     * @return Movie
     */
    public function setReleaseDate(string $releaseDate): Movie
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * Accesseur de l'attribut runtime de l'entité.
     * @return int
     */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /**
     * Modificateur de l'attribut runtime de l'entité.
     * @param int $runtime
     * @return Movie
     */
    public function setRuntime(int $runtime): Movie
    {
        $this->runtime = $runtime;
        return $this;
    }

    /**
     * Accesseur de l'attribut tagline de l'entité.
     * @return string
     */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /**
     * Modificateur de l'attribut tagline de l'entité.
     * @param string $tagline
     * @return Movie
     */
    public function setTagline(string $tagline): Movie
    {
        $this->tagline = $tagline;
        return $this;
    }

    /**
     * Accesseur de l'attribut title de l'entité.
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Modificateur de l'attribut title de l'entité.
     * C'est le seul attribut de Movie qui est obligatoire.
     * @param string $title
     * @return Movie
     */
    public function setTitle(string $title): Movie
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Méthode affichant le poster, le titre, la date de sortie,
     * ses acteurs ainsi que leur rôle. Dans le cas où le film n'aurait
     * pas de poster définis, une image sera affiché à la place.
     * @param int $PID
     * @return string
     */
    public function getContent(int $PID): string
    {
        return "<a href='DetailsFilm.php?movieId={$this->getId()}'>
                 <img src='ImageMovie.php?imageId={$this->getPosterId()}'>
                 <div> {$this->getTitle()} </div> <div> {$this->getReleaseDate()} </div>
                 <div> {$this->findActorRole($PID)->getRole()} </div><hr>
                 </a>";
    }

    /**
     * Supprime le film correspondant de la base de données.
     * @return void
     */
    public function delete(): void
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                DELETE FROM MOVIE
                WHERE ID = :ID
    SQL
        );
        $stmt->execute([":ID" => $this->id]);
    }

    /**
     * Modifie le film sélectionnée dans la base de données, pour
     * qu'il ait les mêmes valeur que le film appellant la méthode.
     * @return $this film ayant appellé la fonction
     */
    public function update(): Movie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                UPDATE  MOVIE
                SET     posterId = :PI
                        originalLanguage = :OL,
                        originalTitle = :OT,
                        overview = :OV,
                        releaseDate = :RD,
                        runtime = :RT,
                        tagline = :TG,
                        title = :TT,
                WHERE   id = :ID
    SQL
        );
        echo "Début de Test";
        $stmt->execute([":PI" => $this->posterId, ":OL" => $this->originalLanguage,
            ":OT" => $this->originalTitle, ":OV" => $this->overview,
            ":RD" => $this->releaseDate, ":RT" => $this->runtime,
            ":TG" => $this->tagline, ":TT" => $this->title,
            ":ID" => $this->id]);
        echo "Fin de Test";
        return $this;
    }

    /**
     * Insère dans la base de données le film ayant appellé la fonction.
     * @return $this
     */
    public function insert(): Movie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                INSERT  INTO MOVIE (posterId, originalLanguage, originalTitle, overview, releaseDate, runtime, tagline, title)
                VALUES  (:PI, :OL, :OT, :OV, :RD, :RT, :TG, :TT);
            SQL
        );
        var_dump($this);
        echo "Quelque chose ne vas pas... pas...";
        $stmt->execute([":PI" => $this->getPosterId(), ":OL" => $this->getOriginalLanguage(),
            ":OT" => $this->getOriginalTitle(), ":OV" => $this->getOverview(),
            ":RD" => $this->getReleaseDate(), ":RT" => $this->getRuntime(),
            ":TG" => $this->getTagline(), ":TT" => $this->getTitle()]);
        echo "Si c'est passé, ce message s'affiche";
        $this->id = (int)MyPDO::getInstance()->lastInsertId();
        return $this;
    }

    /**
     * Si le film n'est pas présent dans la base, elle est inséré,
     * sinon elle est mise à jour.
     * @return $this le film sauvegardé
     */
    public function save(): Movie
    {
        if ($this->getId() == null) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }

    /**
     * Créateur d'instance de Movie définissant tous ses attributs.
     * @param int|null $posterId
     * @param string $originalLanguage
     * @param string $originalTitle
     * @param string $overview
     * @param string $releaseDate
     * @param int $runtime
     * @param string $tagline
     * @param string $title
     * @param int|null $id
     * @return Movie
     */
    public static function create(
        int|null $posterId,
        string   $originalLanguage,
        string   $originalTitle,
        string   $overview,
        string   $releaseDate,
        int      $runtime,
        string   $tagline,
        string   $title,
        int|null $id
    ): Movie
    {
        $movie = new Movie();
        $movie->setPosterId($posterId);
        $movie->setOriginalLanguage($originalLanguage);
        $movie->setOriginalTitle($originalTitle);
        $movie->setOverview($overview);
        $movie->setReleaseDate($releaseDate);
        $movie->setRuntime($runtime);
        $movie->setTagline($tagline);
        $movie->setTitle($title);
        $movie->setId($id);
        return $movie;
    }

    /**
     * Retourne tous les film présents dans la base de données.
     * @return array liste de tout les films.
     */
    public static function getAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT *
                FROM movie
                ORDER BY id
            SQL
        );
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Movie::class);
        return $stmt->fetchAll();
    }

    /**
     * Fonction static renvoyant le film correspond à l'id saisit.
     * @param int $Id id du film
     * @return Movie film
     */
    public static function findById(int $Id): Movie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT  *
                FROM    movie
                WHERE   id = :ID
            SQL
        );
        $stmt->execute([":ID" => $Id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Movie::class);
        $res = $stmt->fetchAll();
        if (count($res) == 0) {
            throw new EntityNotFoundException();
        }
        return $res[0];
    }

    /**
     * Liste les acteurs ayant joué dans le film.
     * @return array liste des acteurs
     */
    public function findActorByMovieId(): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM people
        WHERE people.id in (SELECT  peopleId
                            FROM    cast
                            WHERE   movieId = :ID)
        SQL
        );
        $stmt->execute([":ID" => $this->getId()]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Actor::class);
        $res = $stmt->fetchAll();
        if (count($res) == 0) {
            throw new EntityNotFoundException();
        }
        return $res;
    }

    /**
     * Acesseur du role de l'acteur dont on saisie l'id, ayant joué
     * dans le film appellant la méthode.
     * @param int $PID id de l'acteur
     * @return cast rôle de l'acteur
     */
    public function findActorRole($PID): cast
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT  *
            FROM    cast
            WHERE   movieId  = :MID
                    AND peopleId = :PID
        SQL
        );
        $stmt->execute([":MID" => $this->id, ":PID" => $PID]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Cast::class);
        $res = $stmt->fetchAll();
        if (count($res) == 0) {
            throw new EntityNotFoundException();
        }
        return $res[0];
    }
}