<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Movie
{
    private int $posterId;
    private string $originalLanguage;
    private string $originalTitle;
    private string $overview;
    /** Date sous forme 'YYYY-MM-DD'**/
    private string $releaseDate;
    private int $runtime;
    private string $tagline;
    private string $title;
    private int|null $movieId;
    private int $id;

    /**
     * @param int|null $movieId
     */
    public function setMovieId(int $movieId): void
    {
        $this->movieId = $movieId;
    }

    /**
     * Accesseur de l'id du l'instance de Movie.
     * @return int|null
     */
    public function getMovieId(): ?int
    {
        return $this->movieId;
    }

    /**
     * Accesseur de l'attribut posterId de l'entité.
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * Modificateur de l'attribut posterId de l'entité.
     * @param int $posterId
     * @return Movie
     */
    public function setPosterId(int $posterId): Movie
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
     * @param string $title
     * @return Movie
     */
    public function setTitle(string $title): Movie
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

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
        $stmt->execute([":PI" => $this->posterId, ":OL" => $this->originalLanguage,
            ":OT" => $this->originalTitle, ":OV" => $this->overview,
            ":RD" => $this->releaseDate, ":TG" => $this->tagline,
            ":TT" => $this->title, ":ID => $this->id"]);
        return $this;
    }

    public function insert(): Movie
    {
        $this->movieId = (int)MyPDO::getInstance()->lastInsertId();
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                INSERT  INTO ARTIST (posterId, originalLanguage, originalTitle, overview, releaseDate, runtime, tagline, title, movieId)
                VALUES  (:PI, :OL, :OT, :OV, :RD, :RT, :TG, :TT, :ID)
            SQL
        );
        $stmt->execute([":PI" => $this->movieId, ":OL" => $this->originalLanguage,
            ":OT" => $this->originalTitle, ":OV" => $this->overview,
            ":RD" => $this->releaseDate, ":TG" => $this->tagline,
            ":TT" => $this->title, ":ID" => $this->id]);
        return $this;
    }

    public function save(): Movie
    {
        if ($this->movieId == null) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }

    public static function create(
        int    $posterId,
        string $originalLanguage,
        string $originalTitle,
        string $overview,
        string $releaseDate,
        int    $runtime,
        string $tagline,
        string $title
    ): Movie {
        $movie = new Movie();
        $movie->setPosterId($posterId);
        $movie->setOriginalLanguage($originalLanguage);
        $movie->setOriginalTitle($originalTitle);
        $movie->setOverview($overview);
        $movie->setReleaseDate($releaseDate);
        $movie->setRuntime($runtime);
        $movie->setTagline($tagline);
        $movie->setTitle($title);
        return $movie;
    }

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


}
