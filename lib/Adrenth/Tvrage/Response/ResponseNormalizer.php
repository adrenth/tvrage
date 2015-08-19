<?php

namespace Adrenth\Tvrage\Response;

use Adrenth\Tvrage\Aka;
use Adrenth\Tvrage\DetailedShow;
use Adrenth\Tvrage\Network;
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
     * Denormalize Detailed Show
     *
     * @param array $show
     * @return DetailedShow
     */
    final protected function denormalizeDetailedShow(array $show)
    {
        $detailedShow = new DetailedShow();

        $referenceMap = [
            'showid' => 'setShowId',
            'name' => 'setName',
            'showname' => 'setName',
            'link' => 'setLink',
            'showlink' => 'setLink',
            'country' => 'setCountry',
            'origin_country' => 'setOriginCountry',
            'startdate' => 'setStartdate',
            'started' => 'setStarted',
            'ended' => 'setEnded',
            'seasons' => 'setSeasons',
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
            'network' => 'handleNetwork'
        ];

        foreach ($show as $attribute => $value) {
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
     * Handle Genres
     *
     * @param DetailedShow $show
     * @param array        $genres
     * @return void
     */
    protected function handleGenres(DetailedShow $show, $genres)
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
}
