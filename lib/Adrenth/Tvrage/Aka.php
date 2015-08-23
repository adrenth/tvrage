<?php

namespace Adrenth\Tvrage;

/**
 * Class Aka
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
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
     * Get country
     *
     * @return null|string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
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
     * Get custom attribute
     *
     * @return null|string
     */
    public function getAttr()
    {
        return $this->attr;
    }

    /**
     * Set custom attribute
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
     * @return Aka
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
