<?php

namespace Adrenth\Tvrage\Response\Handler;

use Adrenth\Tvrage\Response\Response;

/**
 * Class ResponseHandlerInterface
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
interface ResponseHandlerInterface
{
    /**
     * Handle the response which produces the Response object
     *
     * @return Response
     */
    public function handle();
}
