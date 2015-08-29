<?php

namespace Adrenth\Tvrage\Response\Handler;

use Adrenth\Tvrage\Exception\InvalidXmlInResponseException;
use Adrenth\Tvrage\Response\Traits\TrimsArray;

/**
 * Class XmlResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
abstract class XmlResponseHandler implements ResponseHandlerInterface
{
    use TrimsArray;

    /**
     * XML data
     *
     * @type string
     */
    protected $xml;

    /**
     * Construct
     *
     * @param string $xml XML data
     */
    public function __construct($xml)
    {
        $this->xml = $xml;
    }

    /**
     * @inheritdoc
     * @throws InvalidXmlInResponseException
     */
    abstract public function handle();
}
