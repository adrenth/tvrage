<?php

namespace Adrenth\Tvrage\Response\EpisodeInfo;

use Adrenth\Tvrage\Episode;

/**
 * Class Response
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\EpisodeInfo
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class Response
{
    /**
     * Latest Episode
     *
     * @type Episode
     */
    private $latestEpisode;

    /**
     * Episode
     *
     * @type Episode
     */
    private $episode;

    /**
     * Construct
     *
     * @param Episode|null $latestEpisode
     * @param Episode|null $episode
     */
    public function __construct(Episode $latestEpisode = null, Episode $episode = null)
    {
        $this->latestEpisode = $latestEpisode;
        $this->episode = $episode;
    }

    /**
     * Get latest Episode
     *
     * @return Episode|null
     */
    public function getLatestEpisode()
    {
        return $this->latestEpisode;
    }

    /**
     * Has latest Episode
     *
     * @return bool
     */
    public function hasLatestEpisode()
    {
        return $this->latestEpisode !== null;
    }

    /**
     * Get Episode
     *
     * @return Episode|null
     */
    public function getEpisode()
    {
        return $this->episode;
    }

    /**
     * Has Episode
     *
     * @return bool
     */
    public function hasEpisode()
    {
        return $this->episode !== null;
    }
}
