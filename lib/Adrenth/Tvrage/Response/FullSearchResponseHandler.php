<?php

namespace Adrenth\Tvrage\Response;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * Class FullSearchResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class FullSearchResponseHandler extends ResponseHandler
{
    /**
     * Deserializes data to object(s)
     *
     * @return mixed
     */
    public function deserialize()
    {
        $xmlEncoder = new XmlEncoder();
        $xmlEncoder->setRootNodeName('Results');
        $serializer = new Serializer(
            [new FullSearchResponseNormalizer()],
            [$xmlEncoder]
        );

        return $serializer->deserialize(
            $this->getRawData(),
            'Adrenth\Tvrage\Response\SearchResponse',
            'xml'
        );
    }
}