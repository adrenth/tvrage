<?php

namespace Adrenth\Tvrage;

/**
 * Class Show
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
class Show
{
    /**
     * Identifier
     *
     * @type integer
     */
    protected $showId;

    /**
     * Name
     *
     * @type string
     */
    protected $name;

    /**
     * Link
     *
     * @type string
     */
    protected $link;

    /**
     * Show is ended
     *
     * @type bool
     */
    protected $ended;

    /**
     * Country
     *
     * @type string
     */
    protected $country;

    /**
     * Number of seasons
     *
     * @type integer
     */
    protected $seasonCount;

    /**
     * Status
     *
     * @type string
     */
    protected $status;

    /**
     * Classification
     *
     * @type string
     */
    protected $classification;

    /**
     * Genres
     *
     * @type array
     */
    protected $genres = [];

    /**
     * Get showId
     *
     * @return int
     */
    public function getShowId()
    {
        return $this->showId;
    }

    /**
     * Set showId
     *
     * @param int $showId
     *
     * @return $this
     */
    public function setShowId($showId)
    {
        $this->showId = (int) $showId;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return $this
     */
    public function setLink($link)
    {
        if (!is_null($link) && substr($link, 0, 17) === 'http://www.tvrage') {
            $link = str_replace('www.tvrage', 'tvrage', $link);
        }
        $this->link = $link;
        return $this;
    }

    /**
     * Get ended
     *
     * @return boolean
     */
    public function isEnded()
    {
        return $this->ended;
    }

    /**
     * Set ended
     *
     * @param boolean $ended
     * @return $this
     */
    public function setEnded($ended)
    {
        $this->ended = (bool)$ended;
        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get seasons
     *
     * @return int
     */
    public function getSeasonCount()
    {
        return $this->seasonCount;
    }

    /**
     * Set season count
     *
     * @param int $seasonCount
     * @return $this
     */
    public function setSeasonCount($seasonCount)
    {
        $this->seasonCount = (int) $seasonCount;
        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get classification
     *
     * @return string
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * Set classification
     *
     * @param string $classification
     * @return $this
     */
    public function setClassification($classification)
    {
        $this->classification = $classification;
        return $this;
    }

    /**
     * Get genres
     *
     * @return array
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Set genres
     *
     * @param array|string $genres
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setGenres($genres)
    {
        if (is_string($genres)) {
            $this->addGenre($genres);
        } elseif (is_array($genres)) {
            $this->genres = array_unique($genres);
        } else {
            throw new \InvalidArgumentException('String or array expected');
        }

        return $this;
    }

    /**
     * Add a genre
     *
     * @param string $genre Genre
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function addGenre($genre)
    {
        if (is_null($genre)) {
            throw new \InvalidArgumentException('Genre cannot be null');
        }

        if (!is_string($genre)) {
            throw new \InvalidArgumentException('Genre must be string');
        }

        if (!in_array($genre, $this->genres)) {
            $this->genres[] = $genre;
        }

        return $this;
    }
}
