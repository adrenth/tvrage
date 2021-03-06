<?php

namespace Adrenth\Tvrage\Response\Handler;

use Adrenth\Tvrage\Exception\InvalidXmlInResponseException;
use Adrenth\Tvrage\Exception\UnimplementedAttributeException;
use Adrenth\Tvrage\Response\SeasonsResponse;
use Adrenth\Tvrage\Response\Traits\DenormalizesDetailedShow;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

/**
 * Class EpisodeListResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
class EpisodeListResponseHandler extends XmlResponseHandler
{
    use DenormalizesDetailedShow;

    /**
     * @inheritdoc
     * @throws UnimplementedAttributeException
     */
    public function handle()
    {
        $encoder = new XmlEncoder('Show');

        try {
            $data = $encoder->decode($this->xml, 'xml');
        } catch (UnexpectedValueException $e) {
            throw new InvalidXmlInResponseException($e->getMessage());
        }

        if (!is_array($data) || !array_key_exists('Episodelist', $data)) {
            return new SeasonsResponse();
        }

        $data = $this->trimArray($data);
        $show = $this->denormalizeDetailedShow($data);

        return new SeasonsResponse($show->getSeasons());
    }
}
