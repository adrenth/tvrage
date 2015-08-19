<?php

namespace Adrenth\Tvrage\Response\Search;

use Adrenth\Tvrage\Show;

/**
 * Class Response
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Search
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class Response
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
     * @return Response
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
