<?php

namespace Adrenth\Tvrage\Response\ShowInfo;

use Adrenth\Tvrage\Response\ResponseNormalizer as BaseResponseNormalizer;

/**
 * Class ResponseNormalizer
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\ShowInfo
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

        if (is_array($normalizedData) && count($normalizedData) !== 0) {
            $show = $this->denormalizeDetailedShow($normalizedData);
            $object->setShow($show);
        }

        return $object;
    }
}
