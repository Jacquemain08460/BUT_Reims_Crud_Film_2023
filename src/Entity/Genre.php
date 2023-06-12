<?php
declare(strict_types=1);

namespace Entity;

class Genre
{
    private int $genreId;
    private string $name;

    /**
     * Accesseur de l'id du genre
     * @return int
     */
    public function getGenreId():int
    {
        return $this->genreId;
    }

    /**
     * Accesseur de l'attribut d'instance name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Modificateur de l'attribut d'instance name.
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}