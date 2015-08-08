<?php

namespace Adrenth\Tvrage;

/**
 * Interface ClientInterface
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
interface ClientInterface
{
    /**
     * Search for TV shows using a query
     *
     * @param string $query Search query
     * @return mixed
     */
    public function search($query);

    /**
     * Search for TV shows using a query
     *
     * The response contains fully detailed information about the TV shows.
     *
     * @param string $query Search query
     * @return mixed
     */
    public function fullSearch($query);

    /**
     * Get show information
     *
     * @param integer $showId TvRage.com assigned Show ID
     * @return mixed
     */
    public function showInfo($showId);

    /**
     * Get detailed TV show information
     *
     * @param integer $showId TvRage.com assigned Show ID
     * @return mixed
     */
    public function fullShowInfo($showId);

    /**
     * Get a list of episodes for given TV show
     *
     * @param integer $showId TvRage.com assigned Show ID
     * @return mixed
     */
    public function episodeList($showId);

    /**
     * Get episode information
     *
     * @param integer $showId  TvRage.com assigned Show ID
     * @param string  $episode Episode, e.g. 2x04
     * @return mixed
     */
    public function episodeInfo($showId, $episode);
}
