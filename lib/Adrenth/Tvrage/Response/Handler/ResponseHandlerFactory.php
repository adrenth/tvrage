<?php

namespace Adrenth\Tvrage\Response\Handler;

use Adrenth\Tvrage\Exception\InvalidHandlerException;

/**
 * Class ResponseHandlerFactory
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class ResponseHandlerFactory
{
    /**
     * Supported Handlers
     *
     * @type array
     */
    public static $supportedHandlers = [
        'Search',
        'FullSearch',
        'ShowInfo',
        'EpisodeList',
        'EpisodeInfo'
    ];

    /**
     * Creates an instance of ResponseHandler
     *
     * @param string $handler
     * @param string $xml
     * @return ResponseHandler
     * @throws InvalidHandlerException
     */
    public static function create($handler, $xml)
    {
        switch ($handler) {
            case 'Search':
                return new SearchResponseHandler($xml);
            case 'FullSearch':
                return new FullSearchResponseHandler($xml);
            case 'ShowInfo':
                return new ShowInfoResponseHandler($xml);
            case 'EpisodeList':
                return new EpisodeListResponseHandler($xml);
            case 'EpisodeInfo':
                return new EpisodeInfoResponseHandler($xml);
            default:
                throw new InvalidHandlerException('Unknown handler ' . $handler);
        }
    }
}
