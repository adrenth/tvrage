<?php

namespace Adrenth\Tvrage;

/**
 * Class Season
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
class Season
{
    /**
     * Number
     *
     * @type integer
     */
    protected $number;

    /**
     * Episodes
     *
     * @type Episode[]
     */
    protected $episodes;

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set number
     *
     * @param int $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Set episodes
     *
     * @param array $episodes
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setEpisodes(array $episodes)
    {
        $this->episodes = [];

        foreach ($episodes as $episode) {
            $this->addEpisode($episode);
        }

        return $this;
    }

    /**
     * @param Episode $episode
     * @return $this
     */
    public function addEpisode(Episode $episode)
    {
        $this->episodes[] = $episode;
        return $this;
    }

    /**
     * Get episodes
     *
     * @return array
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }

    /**
     * Has episodes
     *
     * @return bool
     */
    public function hasEpisodes()
    {
        return count($this->episodes) !== 0;
    }
}
