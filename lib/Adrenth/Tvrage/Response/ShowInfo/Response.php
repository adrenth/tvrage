<?php

namespace Adrenth\Tvrage\Response\ShowInfo;

use Adrenth\Tvrage\Show;

/**
 * Class Response
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\ShowInfo
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class Response
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
     * @return Response
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
