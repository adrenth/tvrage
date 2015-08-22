<?php

namespace Adrenth\Tvrage;

use Adrenth\Tvrage\Exception\UnexpectedErrorException;
use Adrenth\Tvrage\Response;
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
     * Perform a search
     *
     * @param string $query
     * @return Response\Search\Response
     * @throws UnexpectedErrorException
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

        $responseHandler = new Response\Search\ResponseHandler($xml);
        return $responseHandler->getData();
    }

    /**
     * Perform a full search
     *
     * @param string $query
     * @return Response\Search\Response
     * @throws UnexpectedErrorException
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

        $responseHandler = new Response\FullSearch\ResponseHandler($xml);
        return $responseHandler->getData();
    }

    /**
     * Aquire show information
     *
     * @param int $showId
     * @return Response\ShowInfo\Response
     * @throws UnexpectedErrorException
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

        $responseHandler = new Response\ShowInfo\ResponseHandler($xml);
        return $responseHandler->getData();
    }

    /**
     * Aquire full show information
     *
     * @param int $showId
     * @return Response\ShowInfo\Response
     * @throws UnexpectedErrorException
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

        $responseHandler = new Response\ShowInfo\ResponseHandler($xml);
        return $responseHandler->getData();
    }

    /**
     * Get episode list for show
     *
     * @param int $showId
     * @throws \Exception
     * @return void
     */
    public function episodeList($showId)
    {
        throw new \Exception('Not implemented yet');
    }

    /**
     * Get episode info
     *
     * @param int    $showId
     * @param string $episode
     * @throws \Exception
     * @return void
     */
    public function episodeInfo($showId, $episode)
    {
        throw new \Exception('Not implemented yet');
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
