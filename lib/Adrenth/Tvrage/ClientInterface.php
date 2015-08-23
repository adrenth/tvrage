<?php

namespace Adrenth\Tvrage;

use Adrenth\Tvrage\Response\SearchResponse;

/**
 * Interface ClientInterface
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
interface ClientInterface
{
    /**
     * Search for TV shows using a query
     *
     * @param string $query Search query
     * @return SearchResponse
     */
    public function search($query);

    /**
     * Search for TV shows using a query
     *
     * The response contains fully detailed information about the TV shows.
     *
     * @param string $query Search query
     * @return SearchResponse
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
     * @param string  $season  Season number
     * @param string  $episode Episode number
     * @return mixed
     */
    public function episodeInfo($showId, $season, $episode);
}
