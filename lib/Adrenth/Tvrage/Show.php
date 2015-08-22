<?php

namespace Adrenth\Tvrage;

use Stringy\StaticStringy as S;

/**
 * Class Show
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class Show
{
    /**
     * A map with properties that cannot be automatically converted
     *
     * @type array
     */
    protected static $mapping = [
        'showid' => 'showId',
    ];

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
     * Country
     *
     * @type string
     */
    protected $country;

    /**
     * Year show started on
     *
     * @type int
     */
    protected $started;

    /**
     * Year show ended on
     *
     * @type int
     */
    protected $ended;

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
     * @param int $showId Field Description
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
     * @param string $name Field Description
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
     * @param string $link Field Description
     *
     * @return $this
     */
    public function setLink($link)
    {
        $this->link = $link;
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
     * @param string $country Field Description
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get started
     *
     * @return int
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set started
     *
     * @param int $started Field Description
     * @return $this
     */
    public function setStarted($started)
    {
        $this->started = (int) $started;
        return $this;
    }

    /**
     * Get ended
     *
     * @return int
     */
    public function getEnded()
    {
        return $this->ended;
    }

    /**
     * Set ended
     *
     * @param int $ended Field Description
     * @return $this
     */
    public function setEnded($ended)
    {
        $this->ended = (int) $ended;

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
     * @param string $status Field Description
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
     * @param string $classification Field Description
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
     * @param array|string $genres Field Description
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

    /**
     * Create instance from array
     *
     * @param array $data Array with show information
     * @return $this
     */
    public static function fromArray(array $data)
    {
        throw new \Exception('Do not use');

        $instance = new static();
        $reflection = new \ReflectionClass(static::class);

        foreach ($data as $attribute => $value) {
            if (array_key_exists($attribute, static::$mapping)) {
                $attribute = static::$mapping[$attribute];
            }

            $method = 'set' . S::camelize($attribute);
            if ($reflection->hasProperty($attribute)
                && $reflection->hasMethod($method)
            ) {
                $instance->{$method}($value);
            } else {
                var_dump($attribute);
                var_dump($value);
            }
        }

        return $instance;
    }
}
