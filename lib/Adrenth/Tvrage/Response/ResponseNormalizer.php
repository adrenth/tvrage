<?php

namespace Adrenth\Tvrage\Response;

use Adrenth\Tvrage\Aka;
use Adrenth\Tvrage\DetailedShow;
use Adrenth\Tvrage\Episode;
use Adrenth\Tvrage\Network;
use Adrenth\Tvrage\Season;
use Adrenth\Tvrage\Show;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class ResponseNormalizer
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
abstract class ResponseNormalizer extends ObjectNormalizer
{
    /**
     * @param array $data
     */
    final protected function denormalizeShow(array $data)
    {
        $referenceMap = [
            'showid' => 'setShowId',
            'name' => 'setName',
            'link' => 'setLink',
            'country' => 'setCountry',
            'started' => 'setStarted',
            'ended' => 'setEnded',
            'seasons' => 'setSeasonCount',
            'status' => 'setStatus',
            'classification' => 'setClassification'
        ];

        $complexMap = [
            'genres' => 'handleGenres',
        ];

        $show = new Show();

        foreach ($data as $attribute => $value) {
            if (array_key_exists($attribute, $referenceMap)) {
                $show->$referenceMap[$attribute]($value);
            } elseif (array_key_exists($attribute, $complexMap)) {
                $this->$complexMap[$attribute]($show, $value);
            } else {
                var_dump($attribute);
                var_dump($value);
            }
        }

        return $show;
    }

    /**
     * Denormalize Detailed Show
     *
     * @param array $data
     * @return DetailedShow
     */
    final protected function denormalizeDetailedShow(array $data)
    {
        $detailedShow = new DetailedShow();

        $referenceMap = [
            'showid' => 'setShowId',
            'name' => 'setName',
            'showname' => 'setName',
            'link' => 'setLink',
            'image' => 'setImage',
            'showlink' => 'setLink',
            'country' => 'setCountry',
            'origin_country' => 'setOriginCountry',
            'startdate' => 'setStartdate',
            'started' => 'setStarted',
            'ended' => 'setEnded',
            'seasons' => 'setSeasonCount',
            'totalseasons' => 'setSeasonCount',
            'status' => 'setStatus',
            'runtime' => 'setRuntime',
            'classification' => 'setClassification',
            'airtime' => 'setAirtime',
            'airday' => 'setAirday',
            'timezone' => 'setTimeZone'
        ];

        $complexMap = [
            'akas' => 'handleAkas',
            'genres' => 'handleGenres',
            'network' => 'handleNetwork',
            'Episodelist' => 'handleEpisodeList'
        ];

        foreach ($data as $attribute => $value) {
            if (array_key_exists($attribute, $referenceMap)) {
                $detailedShow->$referenceMap[$attribute]($value);
            } elseif (array_key_exists($attribute, $complexMap)) {
                $this->$complexMap[$attribute]($detailedShow, $value);
            } else {
                var_dump($attribute);
                var_dump($value);
            }
        }

        return $detailedShow;
    }

    /**
     * Handle A.K.A's
     *
     * @param DetailedShow $show
     * @param array        $akas
     * @return void
     */
    private function handleAkas(DetailedShow $show, array $akas)
    {
        if (!array_key_exists('aka', $akas)) {
            return;
        }

        if (is_string($akas['aka'])) {
            $akas['aka'] = [['#' => $akas['aka']]];
        }

        foreach ($akas['aka'] as $attributes) {
            $aka = new Aka();

            if (is_string($attributes)) {
                $aka->setTitle($attributes);
                $show->addAka($aka);
                continue;
            }

            if (array_key_exists('@attr', $attributes)) {
                $aka->setAttr($attributes['@attr']);
            }
            if (array_key_exists('@country', $attributes)) {
                $aka->setCountry($attributes['@country']);
            }
            if (array_key_exists('#', $attributes)) {
                $aka->setTitle($attributes['#']);
            }

            $show->addAka($aka);
        }
    }

    /**
     * Handle Genres
     *
     * @param Show  $show
     * @param array $genres
     * @return void
     * @throws \InvalidArgumentException
     */
    private function handleGenres(Show $show, $genres)
    {
        if (empty($genres)) {
            return;
        }

        if (!array_key_exists('genre', $genres)) {
            return;
        }

        if (is_string($genres['genre'])) {
            $show->addGenre($genres['genre']);
        } elseif (is_array($genres['genre'])) {
            foreach ($genres['genre'] as $genre) {
                if (!empty($genre)) {
                    $show->addGenre($genre);
                }
            }
        }
    }

    /**
     * Handle Network
     *
     * @param DetailedShow $show
     * @param array        $networks
     * @return void
     */
    private function handleNetwork(DetailedShow $show, array $networks)
    {
        $network = new Network();

        if (array_key_exists('@country', $networks)) {
            $network->setCountry($networks['@country']);
        }
        if (array_key_exists('#', $networks)) {
            $network->setName($networks['#']);
        }

        $show->setNetwork($network);
    }

    /**
     * Handle Episodelist
     *
     * @param DetailedShow $show
     * @param array        $episodeList
     */
    private function handleEpisodeList(DetailedShow $show, array $episodeList)
    {
        if (!array_key_exists('Season', $episodeList)) {
            return;
        }

        $seasons = $episodeList['Season'];

        foreach ($seasons as $dataSeason) {
            $season = new Season();
            $season->setNumber($dataSeason['@no']);
            $show->addSeason($season);

            if (!array_key_exists('episode', $dataSeason)
                || !is_array($dataSeason['episode'])
            ) {
                continue;
            }

            foreach ($dataSeason['episode'] as $dataEpisode) {
                $episode = new Episode();

                if (array_key_exists('epnum', $dataEpisode)) {
                    $episode->setNumber($dataEpisode['epnum']);
                }

                if (array_key_exists('title', $dataEpisode)) {
                    $episode->setTitle($dataEpisode['title']);
                }

                if (array_key_exists('airdate', $dataEpisode)) {
                    $episode->setAirdate($dataEpisode['airdate']);
                }

                if (array_key_exists('link', $dataEpisode)) {
                    $episode->setLink($dataEpisode['link']);
                }

                if (array_key_exists('screencap', $dataEpisode)) {
                    $episode->setScreencap($dataEpisode['screencap']);
                }

                $season->addEpisode($episode);
            }
        }
    }
}
