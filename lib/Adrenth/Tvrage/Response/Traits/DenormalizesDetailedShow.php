<?php

namespace Adrenth\Tvrage\Response\Traits;

use Adrenth\Tvrage\Aka;
use Adrenth\Tvrage\DetailedShow;
use Adrenth\Tvrage\Episode;
use Adrenth\Tvrage\Exception\UnimplementedAttributeException;
use Adrenth\Tvrage\Network;
use Adrenth\Tvrage\Season;

/**
 * Trait DenormalizesShow
 *
 * Adds the ability to denormalize an array with detailed tv-show data to it's
 * corresponding object.
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Traits
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
trait DenormalizesDetailedShow
{
    use DenormalizesGenres;

    /**
     * Denormalize Detailed Show
     *
     * @param array $data
     * @return DetailedShow
     * @throws UnimplementedAttributeException
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
            'ended' => 'setEnded',
            'country' => 'setCountry',
            'origin_country' => 'setOriginCountry',
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
            'Episodelist' => 'handleEpisodeList',
        ];

        $ignore = [
            'startdate' => null,
            'started' => null,
        ];

        foreach ($data as $attribute => $value) {
            if (array_key_exists($attribute, $referenceMap)) {
                $detailedShow->$referenceMap[$attribute]($value);
            } elseif (array_key_exists($attribute, $complexMap)) {
                $this->$complexMap[$attribute]($detailedShow, $value);
            } elseif (!array_key_exists($attribute, $ignore)) {
                throw new UnimplementedAttributeException(sprintf(
                    'Attribute %s is not implemented',
                    $attribute
                ));
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
    protected function handleAkas(DetailedShow $show, array $akas)
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
     * Handle Network
     *
     * @param DetailedShow $show
     * @param array        $networks
     * @return void
     */
    protected function handleNetwork(DetailedShow $show, array $networks)
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
     * @return void
     */
    protected function handleEpisodeList(DetailedShow $show, array $episodeList)
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
