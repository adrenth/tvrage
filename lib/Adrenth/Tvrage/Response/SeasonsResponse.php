<?php

namespace Adrenth\Tvrage\Response;

use Adrenth\Tvrage\Season;

/**
 * Class SeasonsResponse
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class SeasonsResponse implements Response
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
    public function __construct(array $seasons = [])
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
     * Get seasons
     *
     * @return array
     */
    public function getSeasons()
    {
        return $this->seasons;
    }

    /**
     * Has seasons
     *
     * @return bool
     */
    public function hasSeasons()
    {
        return count($this->seasons) !== 0;
    }
}
