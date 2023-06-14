<?php

declare(strict_types=1);

namespace Entity;

class Genre
{
    private string $name;
    private int $id;

    /**
     * Accesseur de l'id du genre
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
