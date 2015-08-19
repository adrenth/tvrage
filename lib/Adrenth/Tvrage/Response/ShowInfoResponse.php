<?php

namespace Adrenth\Tvrage\Response;

use Adrenth\Tvrage\Show;

/**
 * Class ShowInfoResponse
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class ShowInfoResponse
{
    /**
     * Show
     *
     * @type Show
     */
    private $show;

    /**
     * Get show
     *
     * @return mixed
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * Set show
     *
     * @param Show $show
     * @return ShowInfoResponse
     */
    public function setShow(Show $show)
    {
        $this->show = $show;

        return $this;
    }

    /**
     * Has show
     *
     * @return bool
     */
    public function hasShow()
    {
        return $this->show !== null;
    }
}
