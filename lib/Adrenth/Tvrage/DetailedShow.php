<?php

namespace Adrenth\Tvrage;

/**
 * Class DetailedShow
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class DetailedShow extends Show
{
    /**
     * A map with properties that cannot be automatically converted
     *
     * @type array
     */
    protected static $mapping = [
        'showid' => 'showId'
    ];

    /**
     * Startdate
     *
     * @type string
     */
    protected $startdate;

    /**
     * Runtime in minutes
     *
     * @type integer
     */
    protected $runtime;

    /**
     * Network
     *
     * @type Network
     */
    protected $network;

    /**
     * Airtime
     *
     * @type string
     */
    protected $airtime;

    /**
     * Airday
     *
     * @type string
     */
    protected $airday;

    /**
     * A.K.A.S (Also Know As)
     *
     * @type array
     */
    protected $akas;

    /**
     * Origin Country
     *
     * @type string
     */
    protected $originCountry;

    /**
     * Time zone
     *
     * @type string
     */
    protected $timeZone;

    /**
     * Get startdate
     *
     * @return string
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set startdate
     *
     * @param string $startdate
     * @return DetailedShow
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get runtime
     *
     * @return int minutes
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * Set runtime in minutes
     *
     * @param int $runtime
     * @return DetailedShow
     */
    public function setRuntime($runtime)
    {
        $this->runtime = (int) $runtime;

        return $this;
    }

    /**
     * Get Network
     *
     * @return Network
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * Set Network
     *
     * @param Network $network
     * @return DetailedShow
     */
    public function setNetwork(Network $network)
    {
        $this->network = $network;

        return $this;
    }

    /**
     * Get Airtime
     *
     * @return string
     */
    public function getAirtime()
    {
        return $this->airtime;
    }

    /**
     * Set Airtime
     *
     * @param string $airtime
     * @return DetailedShow
     */
    public function setAirtime($airtime)
    {
        $this->airtime = $airtime;

        return $this;
    }

    /**
     * Get Airday
     *
     * @return string
     */
    public function getAirday()
    {
        return $this->airday;
    }

    /**
     * Set Air Day
     *
     * @param string $airday
     * @return DetailedShow
     */
    public function setAirday($airday)
    {
        $this->airday = $airday;

        return $this;
    }

    /**
     * Get A.K.A's
     *
     * @return array
     */
    public function getAkas()
    {
        return $this->akas;
    }

    /**
     * Set A.K.A's
     *
     * @param array $akas
     * @return DetailedShow
     */
    public function setAkas(array $akas)
    {
        $this->akas = [];

        foreach ($akas as $aka) {
            $this->addAka($aka);
        }

        return $this;
    }

    /**
     * Add A.K.A
     *
     * @param Aka $aka
     * @return DetailedShow
     */
    public function addAka(Aka $aka)
    {
        $this->akas[] = $aka;

        return $this;
    }

    /**
     * Get origin country
     *
     * @return string
     */
    public function getOriginCountry()
    {
        return $this->originCountry;
    }

    /**
     * Set origin country
     *
     * @param string $originCountry
     * @return DetailedShow
     */
    public function setOriginCountry($originCountry)
    {
        $this->originCountry = $originCountry;

        return $this;
    }

    /**
     * Get time zone
     *
     * @return string
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * Set time zone
     *
     * @param string $timeZone
     * @return DetailedShow
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;

        return $this;
    }
}
