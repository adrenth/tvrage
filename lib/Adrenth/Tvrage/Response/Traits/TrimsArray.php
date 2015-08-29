<?php

namespace Adrenth\Tvrage\Response\Traits;

/**
 * Trait TrimsArray
 *
 * Adds the ability to trim array string values
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Traits
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
trait TrimsArray
{
    /**
     * Trim Array
     *
     * @param array|string $input
     * @return array
     */
    protected function trimArray($input)
    {
        if (!is_array($input)) {
            return trim($input);
        }

        return array_map([$this, 'trimArray'], $input);
    }
}
