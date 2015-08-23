<?php

namespace Adrenth\Tvrage\Response\Handler;

use Adrenth\Tvrage\Exception\InvalidXmlInResponseException;
use Adrenth\Tvrage\Response\ShowResponse;
use Adrenth\Tvrage\Response\Traits\DenormalizesDetailedShow;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

/**
 * Class ShowInfoResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
class ShowInfoResponseHandler extends XmlResponseHandler
{
    use DenormalizesDetailedShow;

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $encoder = new XmlEncoder('Showinfo');

        try {
            $data = $encoder->decode($this->xml, 'xml');
        } catch (UnexpectedValueException $e) {
            throw new InvalidXmlInResponseException($e->getMessage());
        }

        if (is_array($data) && count($data) !== 0) {
            $show = $this->denormalizeDetailedShow($data);
            return new ShowResponse($show);
        }

        return new ShowResponse();
    }
}
