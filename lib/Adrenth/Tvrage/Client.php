<?php

namespace Adrenth\Tvrage;

use Adrenth\Tvrage\Exception\InvalidHandlerException;
use Adrenth\Tvrage\Exception\InvalidXmlInResponseException;
use Adrenth\Tvrage\Exception\UnexpectedErrorException;
use Adrenth\Tvrage\Response\Handler\ResponseHandlerFactory;
use Doctrine\Common\Cache\Cache;
use GuzzleHttp\Client as HttpClient;

/**
 * Class Client
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class Client implements ClientInterface
{
    const API_BASE_URI = 'http://services.tvrage.com';
    const API_PATH_SEARCH = '/feeds/search.php';
    const API_PATH_SEARCH_FULL = '/feeds/full_search.php';
    const API_PATH_SHOW_INFO = '/feeds/showinfo.php';
    const API_PATH_SHOW_INFO_FULL = '/feeds/full_show_info.php';
    const API_PATH_EPISODE_INFO = '/feeds/episodeinfo.php';
    const API_PATH_EPISODE_LIST = '/feeds/episode_list.php';

    /**
     * HTTP Client
     *
     * @type HttpClient
     */
    private $httpClient;

    /**
     * Cache
     *
     * @type Cache
     */
    private $cache;

    /**
     * Cache TTL
     *
     * @type int
     */
    private $cacheTtl = 86400;

    /**
     * Construct
     *
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
        $this->httpClient = new HttpClient(
            [
                'base_uri' => self::API_BASE_URI
            ]
        );
    }

    /**
     * @inheritdoc
     * @throws UnexpectedErrorException
     * @throws InvalidXmlInResponseException
     * @throws InvalidHandlerException
     */
    public function search($query)
    {
        $cacheKey = md5(self::API_PATH_SEARCH . $query);

        if ($this->cache->contains($cacheKey)) {
            $xml = $this->cache->fetch($cacheKey);
        } else {
            $xml = $this->performApiCall(
                self::API_PATH_SEARCH,
                ['show' => $query]
            );

            $this->cache->save($cacheKey, $xml, $this->cacheTtl);
        }

        $responseHandler = ResponseHandlerFactory::create('Search', $xml);
        return $responseHandler->handle();
    }

    /**
     * @inheritdoc
     * @throws UnexpectedErrorException
     * @throws InvalidXmlInResponseException
     * @throws InvalidHandlerException
     */
    public function fullSearch($query)
    {
        $cacheKey = md5(self::API_PATH_SEARCH_FULL . $query);

        if ($this->cache->contains($cacheKey)) {
            $xml = $this->cache->fetch($cacheKey);
        } else {
            $xml = $this->performApiCall(
                self::API_PATH_SEARCH_FULL,
                ['show' => $query]
            );

            $this->cache->save($cacheKey, $xml, $this->cacheTtl);
        }

        $responseHandler = ResponseHandlerFactory::create('FullSearch', $xml);
        return $responseHandler->handle();
    }

    /**
     * @inheritdoc
     * @throws UnexpectedErrorException
     * @throws InvalidXmlInResponseException
     * @throws InvalidHandlerException
     */
    public function showInfo($showId)
    {
        $cacheKey = md5(self::API_PATH_SHOW_INFO . $showId);

        if ($this->cache->contains($cacheKey)) {
            $xml = $this->cache->fetch($cacheKey);
        } else {
            $xml = $this->performApiCall(
                self::API_PATH_SHOW_INFO,
                ['sid' => $showId]
            );

            $this->cache->save($cacheKey, $xml, $this->cacheTtl);
        }

        $responseHandler = ResponseHandlerFactory::create('ShowInfo', $xml);
        return $responseHandler->handle();
    }

    /**
     * @inheritdoc
     * @throws UnexpectedErrorException
     * @throws InvalidXmlInResponseException
     * @throws InvalidHandlerException
     */
    public function fullShowInfo($showId)
    {
        $cacheKey = md5(self::API_PATH_SHOW_INFO_FULL . $showId);

        if ($this->cache->contains($cacheKey)) {
            $xml = $this->cache->fetch($cacheKey);
        } else {
            $xml = $this->performApiCall(
                self::API_PATH_SHOW_INFO_FULL,
                ['sid' => $showId]
            );

            $this->cache->save($cacheKey, $xml, $this->cacheTtl);
        }

        $responseHandler = ResponseHandlerFactory::create('ShowInfo', $xml);
        return $responseHandler->handle();
    }

    /**
     * @inheritdoc
     * @throws UnexpectedErrorException
     * @throws InvalidXmlInResponseException
     * @throws InvalidHandlerException
     */
    public function episodeList($showId)
    {
        $cacheKey = md5(self::API_PATH_EPISODE_LIST . $showId);

        if ($this->cache->contains($cacheKey)) {
            $xml = $this->cache->fetch($cacheKey);
        } else {
            $xml = $this->performApiCall(
                self::API_PATH_EPISODE_LIST,
                ['sid' => $showId]
            );

            $this->cache->save($cacheKey, $xml, $this->cacheTtl);
        }

        $responseHandler = ResponseHandlerFactory::create('EpisodeList', $xml);
        return $responseHandler->handle();
    }

    /**
     * @inheritdoc
     * @throws UnexpectedErrorException
     * @throws InvalidXmlInResponseException
     * @throws InvalidHandlerException
     */
    public function episodeInfo($showId, $season, $episode)
    {
        $cacheKey = md5(self::API_PATH_EPISODE_INFO . $showId . $season . $episode);

        if ($this->cache->contains($cacheKey)) {
            $xml = $this->cache->fetch($cacheKey);
        } else {
            $xml = $this->performApiCall(
                self::API_PATH_EPISODE_INFO,
                [
                    'sid' => $showId,
                    'ep' => $season . 'x' . str_pad($episode, 2, '0', STR_PAD_LEFT)
                ]
            );

            $this->cache->save($cacheKey, $xml, $this->cacheTtl);
        }

        $responseHandler = ResponseHandlerFactory::create('EpisodeInfo', $xml);
        return $responseHandler->handle();
    }

    /**
     * Set cacheTtl
     *
     * @param int $cacheTtl Cache TTL in seconds
     *
     * @return Client
     */
    public function setCacheTtl($cacheTtl)
    {
        $this->cacheTtl = (int) $cacheTtl;

        return $this;
    }

    /**
     * Perform an API call
     *
     * @param string $path  API path (use constants e.g. Client::API_PATH_*)
     * @param array  $query Query parameters
     *
     * @throws UnexpectedErrorException
     *
     * @return string
     */
    private function performApiCall($path, array $query = [])
    {
        $cacheKey = md5($path . serialize($query));

        if ($this->cache->contains($cacheKey)) {
            return $this->cache->fetch($cacheKey);
        }

        $response = $this->httpClient->get($path, ['query' => $query]);

        if ($response->getStatusCode() === 200) {
            $xml = $response->getBody()->getContents();
            $this->cache->save($cacheKey, $xml, $this->cacheTtl);
            return $xml;
        }

        throw new UnexpectedErrorException(
            sprintf(
                'Got status code %d from service at path %s',
                $response->getStatusCode(),
                $path
            )
        );
    }
}
