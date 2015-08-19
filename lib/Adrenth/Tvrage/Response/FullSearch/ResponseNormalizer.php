<?php

namespace Adrenth\Tvrage\Response\FullSearch;

use Adrenth\Tvrage\Response\ResponseNormalizer as BaseResponseNormalizer;
use Adrenth\Tvrage\Response\Search\Response;

/**
 * Class ResponseNormalizer
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\FullSearch
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class ResponseNormalizer extends BaseResponseNormalizer
{
    /**
     * {@inheritdoc}
     *
     * @return Response
     */
    public function denormalize(
        $data,
        $class,
        $format = null,
        array $context = array()
    ) {
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
