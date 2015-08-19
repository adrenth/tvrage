<?php

namespace Adrenth\Tvrage\Response;

/**
 * Class FullSearchResponseNormalizer
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class FullSearchResponseNormalizer extends ResponseNormalizer
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
            $show = $this->denormalizeDetailedShow($show);
            $object->addShow($show);
        }

        return $object;
    }
}
