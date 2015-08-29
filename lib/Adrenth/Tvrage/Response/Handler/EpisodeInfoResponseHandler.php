<?php

namespace Adrenth\Tvrage\Response\Handler;

use Adrenth\Tvrage\Episode;
use Adrenth\Tvrage\Exception\InvalidXmlInResponseException;
use Adrenth\Tvrage\Response\EpisodeResponse;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

/**
 * Class EpisodeInfoResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
class EpisodeInfoResponseHandler extends XmlResponseHandler
{
    /**
     * @inheritdoc
     */
    public function handle()
    {
        $encoder = new XmlEncoder('show');

        try {
            $data = $encoder->decode($this->xml, 'xml');
        } catch (UnexpectedValueException $e) {
            throw new InvalidXmlInResponseException($e->getMessage());
        }

        if (!is_array($data)
            || (
                !array_key_exists('episode', $data)
                && !array_key_exists('latestepisode', $data)
            )
        ) {
            return new EpisodeResponse(null, null);
        }

        $data = $this->trimArray($data);
        $episode = $latestEpisode = null;

        if (array_key_exists('episode', $data)) {
            $episode = $this->handleEpisode($data['episode']);
        }

        if (array_key_exists('latestepisode', $data)) {
            $latestEpisode = $this->handleEpisode($data['latestepisode']);
        }

        return new EpisodeResponse($latestEpisode, $episode);
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
