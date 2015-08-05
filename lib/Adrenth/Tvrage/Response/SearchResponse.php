<?php

namespace Adrenth\Tvrage\Response;

use Adrenth\Tvrage\Show;

/**
 * Class SearchResponse
 *
 * @package Adrenth\Tvrage
 */
class SearchResponse
{
    /**
     * Shows
     *
     * @var array
     */
    private $shows;

    /**
     * Add Show
     *
     * @param Show $show
     * @return SearchResponse
     */
    public function addShow(Show $show)
    {
        $this->shows[] = $show;

        return $this;
    }
}
