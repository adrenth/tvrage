<?php

namespace Adrenth\Tvrage\Response\Handler;

use Adrenth\Tvrage\Exception\InvalidXmlInResponseException;
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
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class EpisodeListResponseHandler extends XmlResponseHandler
{
    use DenormalizesDetailedShow;

    /**
     * @inheritdoc
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

        $show = $this->denormalizeDetailedShow($data);

        return new SeasonsResponse($show->getSeasons());
    }
}
