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
     * @var string
     */
    protected $title;

    /**
     * Season number
     *
     * @var integer
     */
    protected $season;

    /**
     * Episode number
     *
     * @var integer
     */
    protected $episode;

    /**
     * Airdate
     *
     * @var \DateTime|null
     */
    protected $airdate;

    /**
     * Link
     *
     * @var string
     */
    protected $link;

    /**
     * Screen Capture
     *
     * @var string
     */
    protected $screencap;

    /**
     * Runtime in minutes
     *
     * @var integer
     */
    protected $runtime;
}
