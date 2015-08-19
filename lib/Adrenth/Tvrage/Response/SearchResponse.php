<?php

namespace Adrenth\Tvrage\Response;

use Adrenth\Tvrage\Show;

/**
 * Class SearchResponse
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class SearchResponse
{
    /**
     * Shows
     *
     * @type array
     */
    private $shows;

    /**
     * Add show
     *
     * @param Show $show
     * @return SearchResponse
     */
    public function addShow(Show $show)
    {
        $this->shows[] = $show;

        return $this;
    }

    /**
     * Get shows
     *
     * @return array
     */
    public function getShows()
    {
        return $this->shows;
    }

    /**
     * Has shows
     *
     * @return bool
     */
    public function hasShows()
    {
        return count($this->shows) !== 0;
    }
}
