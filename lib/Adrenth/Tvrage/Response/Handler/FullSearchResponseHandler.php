<?php

namespace Adrenth\Tvrage\Response\Handler;

use Adrenth\Tvrage\Exception\UnimplementedAttributeException;
use Adrenth\Tvrage\Response\Traits\DenormalizesDetailedShow;

/**
 * Class FullSearchResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
class FullSearchResponseHandler extends SearchResponseHandler
{
    use DenormalizesDetailedShow;

    /**
     * Denormalize shows
     *
     * @param array $items
     * @return array
     * @throws UnimplementedAttributeException
     */
    protected function denormalize(array $items)
    {
        $shows = [];

        foreach ($items as $show) {
            $show = $this->denormalizeDetailedShow($show);
            $shows[] = $show;
        }

        return $shows;
    }
}
