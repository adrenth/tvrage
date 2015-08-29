<?php

namespace Adrenth\Tvrage\Response;

use Adrenth\Tvrage\Show;

/**
 * Class ShowsResponse
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
class ShowsResponse implements ResponseInterface
{
    /**
     * Shows
     *
     * @type array
     */
    private $shows;

    /**
     * Construct
     *
     * @param array $shows
     */
    public function __construct(array $shows = [])
    {
        foreach ($shows as $show) {
            $this->addShow($show);
        }
    }

    /**
     * Add show
     *
     * @param Show $show
     * @return $this
     */
    private function addShow(Show $show)
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
