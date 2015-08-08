<?php

namespace Adrenth\Tvrage;

/**
 * Class Aka
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class Aka
{
    /**
     * Country Code
     *
     * @type string|null
     */
    protected $country;

    /**
     * Extra attribute e.g 'Alternate title', 'Unofficial Working Title'
     *
     * @type string|null
     */
    protected $attr;

    /**
     * Title
     *
     * @type string
     */
    protected $title;

    /**
     * Get
     *
     * @return null|string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set
     *
     * @param null|string $country
     * @return Aka
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get
     *
     * @return null|string
     */
    public function getAttr()
    {
        return $this->attr;
    }

    /**
     * Set
     *
     * @param null|string $attr
     * @return Aka
     */
    public function setAttr($attr)
    {
        $this->attr = $attr;

        return $this;
    }

    /**
     * Get
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set
     *
     * @param string $title
     * @return Aka
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
