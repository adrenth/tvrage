<?php

namespace Adrenth\Tvrage;

/**
 * Class FullSearchResponseNormalizer
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class Network
{
    /**
     * Country Code
     *
     * @type string
     */
    protected $country;

    /**
     * Name
     *
     * @type string
     */
    protected $name;

    /**
     * Get
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set
     *
     * @param string $country
     * @return Network
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set
     *
     * @param string $name
     * @return Network
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
