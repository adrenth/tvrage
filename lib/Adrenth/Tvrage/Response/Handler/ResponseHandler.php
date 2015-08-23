<?php

namespace Adrenth\Tvrage\Response\Handler;

use Adrenth\Tvrage\Response\Response;

/**
 * Class ResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
interface ResponseHandler
{
    /**
     * Handle the response which produces the Response object
     *
     * @return Response
     */
    public function handle();
}
