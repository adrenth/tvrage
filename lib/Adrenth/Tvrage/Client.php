<?php


namespace Adrenth\Tvrage;

use Adrenth\Tvrage\Exception\UnexpectedErrorException;
use Adrenth\Tvrage\Response\SearchResponseHandler;
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
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Cache
     *
     * @var Cache
     */
    private $cache;

    /**
     * Cache TTL
     *
     * @var int
     */
    private $cacheTtl = 86400;

    /**
     * Construct
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
     * {@inheritdoc}
     *
     * @throws UnexpectedErrorException
     */
    public function search($query)
    {
        $xml = $this->_performApiCall(self::API_PATH_SEARCH, ['show' => $query]);
        $responseSearch = new SearchResponseHandler($xml);

        var_dump($responseSearch);
    }

    public function fullSearch($query)
    {

    }

    public function showInfo($showId)
    {

    }

    public function fullShowInfo($showId)
    {

    }

    public function episodeList($showId)
    {

    }

    public function episodeInfo($showId, $episode)
    {

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
    private function _performApiCall($path, array $query = [])
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
