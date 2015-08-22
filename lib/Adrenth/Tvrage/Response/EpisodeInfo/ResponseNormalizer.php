<?php

namespace Adrenth\Tvrage\Response\EpisodeInfo;

use Adrenth\Tvrage\Episode;
use Adrenth\Tvrage\Response\ResponseNormalizer as BaseResponseNormalizer;

/**
 * Class ResponseNormalizer
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\EpisodeInfo
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

        if (!array_key_exists('episode', $normalizedData)
            && !array_key_exists('latestepisode', $normalizedData)
        ) {
            return new Response(null, null);
        }

        $episode = $latestEpisode = null;

        if (array_key_exists('episode', $normalizedData)) {
            $data = $normalizedData['episode'];
            $episode = $this->handleEpisode($data);
        }

        if (array_key_exists('latestepisode', $normalizedData)) {
            $data = $normalizedData['latestepisode'];
            $latestEpisode = $this->handleEpisode($data);
        }

        return new Response($latestEpisode, $episode);
    }

    /**
     * Handle episode
     *
     * @param array $data
     * @return Episode
     */
    private function handleEpisode(array $data)
    {
        $episode = new Episode();

        if (array_key_exists('number', $data)) {
            $number = explode('x', $data['number']);
            if (array_key_exists(0, $number)) {
                $episode->setSeasonNumber($number[0]);
            }
            if (array_key_exists(1, $number)) {
                $episode->setNumber($number[1]);
            }
        }

        if (array_key_exists('title', $data)) {
            $episode->setTitle($data['title']);
        }

        if (array_key_exists('airdate', $data)) {
            $episode->setAirdate($data['airdate']);
        }

        if (array_key_exists('url', $data)) {
            $episode->setLink($data['url']);
        }

        return $episode;
    }
}
