<?php

namespace Adrenth\Tvrage\Response;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SearchResponse
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class SearchResponseHandler extends ResponseHandler
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
            [new SearchResponseNormalizer()],
            [$xmlEncoder]
        );

        return $serializer->deserialize(
            $this->getRawData(),
            'Adrenth\Tvrage\Response\SearchResponse',
            'xml'
        );
    }
}
