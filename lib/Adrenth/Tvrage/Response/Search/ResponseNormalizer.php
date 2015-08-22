<?php

namespace Adrenth\Tvrage\Response\Search;

use Adrenth\Tvrage\Show;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class ResponseNormalizer
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Search
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class ResponseNormalizer extends ObjectNormalizer
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
            $object->addShow(Show::fromArray($show));
        }

        return $object;
    }
}