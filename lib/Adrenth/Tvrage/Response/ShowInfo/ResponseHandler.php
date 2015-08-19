<?php

namespace Adrenth\Tvrage\Response\ShowInfo;

use Adrenth\Tvrage\Response\ResponseHandler as BaseResponseHandler;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\ShowInfo
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class ResponseHandler extends BaseResponseHandler
{
    /**
     * Deserialize data to object(s)
     *
     * @return mixed
     */
    public function deserialize()
    {
        $xmlEncoder = new XmlEncoder();
        $xmlEncoder->setRootNodeName('Showinfo');
        $serializer = new Serializer(
            [new ResponseNormalizer()],
            [$xmlEncoder]
        );

        return $serializer->deserialize(
            $this->getRawData(),
            'Adrenth\Tvrage\Response\ShowInfo\Response',
            'xml'
        );
    }
}
