<?php
declare(strict_types=1);

namespace Entity;

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
     */
    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
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
     */
    public function setOriginalLanguage(string $originalLanguage): void
    {
        $this->originalLanguage = $originalLanguage;
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
     */
    public function setOriginalTitle(string $originalTitle): void
    {
        $this->originalTitle = $originalTitle;
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
     */
    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
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
     */
    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
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
     */
    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
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
     */
    public function setTagline(string $tagline): void
    {
        $this->tagline = $tagline;
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
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }



}