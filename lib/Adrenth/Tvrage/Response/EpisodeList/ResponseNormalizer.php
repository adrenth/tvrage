<?php

namespace Adrenth\Tvrage\Response\EpisodeList;

use Adrenth\Tvrage\Response\ResponseNormalizer as BaseResponseNormalizer;

/**
 * Class ResponseNormalizer
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\EpisodeList
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
        $normalizedData = $this->prepareForDenormalization($data);

        if (!array_key_exists('Episodelist', $normalizedData)) {
            return new Response([]);
        }

        $show = $this->denormalizeDetailedShow($normalizedData);

        return new Response($show->getSeasons());
    }
}
