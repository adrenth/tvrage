<?php

namespace Adrenth\Tvrage\Response;

/**
 * Class ShowInfoResponseNormalizer
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class ShowInfoResponseNormalizer extends ResponseNormalizer
{
    /**
     * {@inheritdoc}
     *
     * @return ShowInfoResponse
     */
    public function denormalize(
        $data,
        $class,
        $format = null,
        array $context = array()
    ) {
        /* @type $object ShowInfoResponse */
        $object = parent::denormalize($data, $class, $format, $context);
        $normalizedData = $this->prepareForDenormalization($data);

        if (is_array($normalizedData) && count($normalizedData) !== 0) {
            $show = $this->denormalizeDetailedShow($normalizedData);
            $object->setShow($show);
        }

        return $object;
    }
}