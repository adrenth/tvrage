<?php

namespace Adrenth\Tvrage\Response\Traits;

use Adrenth\Tvrage\Exception\UnimplementedAttributeException;
use Adrenth\Tvrage\Show;

/**
 * Trait DenormalizesShow
 *
 * Adds the ability to denormalize an array with tv-show data to it's
 * corresponding object.
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Traits
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
trait DenormalizesShow
{
    use DenormalizesGenres;

    /**
     * Denormalize Show
     *
     * @param array $data
     * @return Show
     * @throws UnimplementedAttributeException
     */
    final protected function denormalizeShow(array $data)
    {
        $referenceMap = [
            'showid' => 'setShowId',
            'name' => 'setName',
            'link' => 'setLink',
            'ended' => 'setEnded',
            'country' => 'setCountry',
            'seasons' => 'setSeasonCount',
            'status' => 'setStatus',
            'classification' => 'setClassification'
        ];

        $complexMap = [
            'genres' => 'handleGenres',
        ];

        $ignore = [
            'started' => null,
        ];

        $show = new Show();

        foreach ($data as $attribute => $value) {
            if (array_key_exists($attribute, $referenceMap)) {
                $show->$referenceMap[$attribute]($value);
            } elseif (array_key_exists($attribute, $complexMap)) {
                $this->$complexMap[$attribute]($show, $value);
            } elseif (!array_key_exists($attribute, $ignore)) {
                throw new UnimplementedAttributeException(sprintf(
                    'Attribute %s is not implemented',
                    $attribute
                ));
            }
        }

        return $show;
    }
}