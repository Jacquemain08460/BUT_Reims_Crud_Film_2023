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
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->movieId;
    }

    /**
     * @param int $movieId
     * @return Cast
     */
    public function setMovieId(int $movieId): Cast
    {
        $this->movieId = $movieId;
        return $this;
    }

    /**
     * @return int
     */
    public function getPeopleId(): int
    {
        return $this->peopleId;
    }

    /**
     * @param int $peopleId
     * @return Cast
     */
    public function setPeopleId(int $peopleId): Cast
    {
        $this->peopleId = $peopleId;
        return $this;
    }


    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return Cast
     */
    public function setRole(string $role): Cast
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderIndex(): int
    {
        return $this->orderIndex;
    }

    /**
     * @param int $orderIndex
     * @return Cast
     */
    public function setOrderIndex(int $orderIndex): Cast
    {
        $this->orderIndex = $orderIndex;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Cast
     */
    public function setId(int $id): Cast
    {
        $this->id = $id;
        return $this;
    }
}
