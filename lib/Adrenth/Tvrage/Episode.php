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
    protected $season;

    /**
     * Episode number
     *
     * @type integer
     */
    protected $episode;

    /**
     * Airdate
     *
     * @type \DateTime|null
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

    // TODO
}
