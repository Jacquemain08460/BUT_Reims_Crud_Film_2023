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
    private int $id;

    /**
     * Accesseur de l'id du film correspondant au casting.
     * @return int id du film
     */
    public function getMovieId(): int
    {
        return $this->movieId;
    }

    /**
     * Modificateur de l'id de film associé au casting
     * (l'affecte à un autre film).
     * @param int $movieId nouvel id de film
     * @return Cast Casting subissant la modification
     */
    public function setMovieId(int $movieId): Cast
    {
        $this->movieId = $movieId;
        return $this;
    }

    /**
     * Acesseur de l'id de la personne affecté au casting.
     * @return int id de la personne
     */
    public function getPeopleId(): int
    {
        return $this->peopleId;
    }

    /**
     * Modificateur de l'id de personne affecté au casting
     * (affecte le casting à une autre personne).
     * @param int $peopleId nouvel id de personne
     * @return Cast Casting modifié
     */
    public function setPeopleId(int $peopleId): Cast
    {
        $this->peopleId = $peopleId;
        return $this;
    }


    /**
     * Acesseur du rôle attribué au casting.
     * @return string rôle du castiong
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Modificateur du rôle attribué (attribue un autre rôle).
     * @param string $role nouveau rôle
     * @return Cast casting modifié
     */
    public function setRole(string $role): Cast
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Acesseur de l'index de l'ordre du casting.
     * @return int index
     */
    public function getOrderIndex(): int
    {
        return $this->orderIndex;
    }

    /**
     * Modificateur de l'index de l'odre du casting.
     * @param int $orderIndex nouvel index
     * @return Cast casting modifié
     */
    public function setOrderIndex(int $orderIndex): Cast
    {
        $this->orderIndex = $orderIndex;
        return $this;
    }

    /**
     * Acesseur de l'id du casting
     * @return int id du casting
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Modificateur de l'id du casting
     * @param int $id nouvel id du casting
     * @return Cast casting modifié
     */
    public function setId(int $id): Cast
    {
        $this->id = $id;
        return $this;
    }
}

