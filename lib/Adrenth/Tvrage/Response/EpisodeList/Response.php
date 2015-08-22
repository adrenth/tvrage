<?php

namespace Adrenth\Tvrage\Response\EpisodeList;

use Adrenth\Tvrage\Season;

/**
 * Class Response
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\EpisodeList
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class Response
{
    /**
     * Seasons
     *
     * @type array
     */
    private $seasons;

    /**
     * Construct
     *
     * @param array $seasons
     */
    public function __construct(array $seasons)
    {
        foreach ($seasons as $season) {
            $this->addSeason($season);
        }
    }

    /**
     * Add season
     *
     * @param Season $season
     * @return $this
     */
    private function addSeason(Season $season)
    {
        $this->seasons[] = $season;
        return $this;
    }

    /**
     * Seasons
     *
     * @return array
     */
    public function getSeasons()
    {
        return $this->seasons;
    }
}