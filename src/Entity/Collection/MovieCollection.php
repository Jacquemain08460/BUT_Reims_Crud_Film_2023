<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use Entity\Movie;
use PDO;

class MovieCollection
{
    /**
     * Liste tous les films de la base de données.
     * @return array liste des films de la base de données
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
     * Acesseur de l'ensemble des film du genre paramétré.
     * @param int $genreId genre paramétré.
     * @return array Liste des films
     */
    public static function getMovieByGenre(int $genreId):array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT  *
            FROM    movie
                    JOIN movie_genre ON (movie.id = movie_genre.movieId)
                    JOIN genre ON (movie_genre.genreId = genre.id)
            WHERE genre.id =  :ID  
        SQL
        );
        $stmt->execute([":ID" => $genreId]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Movie::class);
        $res = $stmt->fetchAll();
        if (count($res) == 0) {
            throw new EntityNotFoundException();
        }
        return $res;
    }

    /**
     * Acesseur de tout les films, soit d'un genre si
     * paramétrés, soit tout les films de la base de données.
     * @param int|null $genreId genre paramétré
     * @return array Liste des films
     */
    public static function getMovies(int $genreId=null):array
    {
        if(!isset($genreId))
        {
            return MovieCollection::getAll();
        }else
        {
            return MovieCollection::getMovieByGenre($genreId);
        }
    }
}