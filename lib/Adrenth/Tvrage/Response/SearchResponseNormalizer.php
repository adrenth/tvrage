<?php

namespace Adrenth\Tvrage\Response;

use Adrenth\Tvrage\Show;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class SearchResponseNormalizer
 *
 * @package Adrenth\Tvrage\Response
 */
class SearchResponseNormalizer extends ObjectNormalizer
{
    /**
     * {@inheritdoc}
     *
     * @return SearchResponse
     */
    public function denormalize(
        $data,
        $class,
        $format = null,
        array $context = array()
    ) {
        /* @type $object SearchResponse */
        $object = parent::denormalize($data, $class, $format, $context);
        $normalizedData = $this->prepareForDenormalization($data);

        if (!array_key_exists('show', $normalizedData)) {
            return $object;
        }

        foreach ($normalizedData['show'] as $show) {
            $object->addShow(Show::fromArray($show));
        }

        return $object;
    }
}
