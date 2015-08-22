<?php

namespace Adrenth\Tvrage\Response\EpisodeList;

use Adrenth\Tvrage\Response\ResponseHandler as BaseResponseHandler;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\EpisodeList
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class ResponseHandler extends BaseResponseHandler
{
    /**
     * Deserializes data to object(s)
     *
     * @return mixed
     */
    public function deserialize()
    {
        $xmlEncoder = new XmlEncoder();
        $xmlEncoder->setRootNodeName('Show');
        $serializer = new Serializer(
            [new ResponseNormalizer()],
            [$xmlEncoder]
        );

        return $serializer->deserialize(
            $this->getRawData(),
            'Adrenth\Tvrage\Response\EpisodeList\Response',
            'xml'
        );
    }
}
