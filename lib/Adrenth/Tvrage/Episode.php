<?php

namespace Adrenth\Tvrage;

/**
 * Class Episode
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class Episode
{
    /**
     * Title
     *
     * @type string
     */
    protected $title;

    /**
     * Season number
     *
     * @type integer
     */
    protected $number;

    /**
     * Season number
     *
     * @type integer
     */
    protected $seasonNumber;

    /**
     * Airdate
     *
     * @type string
     */
    protected $airdate;

    /**
     * Link
     *
     * @type string
     */
    protected $link;

    /**
     * Screen Capture
     *
     * @type string
     */
    protected $screencap;

    /**
     * Runtime in minutes
     *
     * @type integer
     */
    protected $runtime;

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

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
        $this->number = (int)$number;
        return $this;
    }

    /**
     * Get season number
     *
     * @return int
     */
    public function getSeasonNumber()
    {
        return $this->seasonNumber;
    }

    /**
     * Set season number
     *
     * @param int $seasonNumber
     * @return $this
     */
    public function setSeasonNumber($seasonNumber)
    {
        $this->seasonNumber = (int)$seasonNumber;
        return $this;
    }

    /**
     * Get air date
     *
     * @return string
     */
    public function getAirdate()
    {
        return $this->airdate;
    }

    /**
     * Set air date
     *
     * @param string $airdate
     * @return $this
     */
    public function setAirdate($airdate)
    {
        $this->airdate = $airdate;
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
     * @return $this
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * Get screencap
     *
     * @return string
     */
    public function getScreencap()
    {
        return $this->screencap;
    }

    /**
     * Set screencap
     *
     * @param string $screencap
     * @return $this
     */
    public function setScreencap($screencap)
    {
        $this->screencap = $screencap;
        return $this;
    }

    /**
     * Get runtime
     *
     * @return int
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * Set runtime
     *
     * @param int $runtime
     * @return $this
     */
    public function setRuntime($runtime)
    {
        $this->runtime = $runtime;
        return $this;
    }
}
