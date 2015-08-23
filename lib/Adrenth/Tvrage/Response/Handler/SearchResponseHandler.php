<?php

namespace Adrenth\Tvrage\Response\Handler;

use Adrenth\Tvrage\Exception\InvalidXmlInResponseException;
use Adrenth\Tvrage\Response\ShowsResponse;
use Adrenth\Tvrage\Response\Traits\DenormalizesShow;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

/**
 * Class SearchResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response\Handler
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
class SearchResponseHandler extends XmlResponseHandler
{
    use DenormalizesShow;

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $encoder = new XmlEncoder('Results');

        try {
            $data = $encoder->decode($this->xml, 'xml');
        } catch (UnexpectedValueException $e) {
            throw new InvalidXmlInResponseException($e->getMessage());
        }

        // Search has no results
        if (is_string($data) && $data === '0') {
            return new ShowsResponse();
        }

        if (!is_array($data) || !array_key_exists('show', $data)) {
            throw new InvalidXmlInResponseException(
                'No `show` element found in XML data.'
            );
        }

        $shows = $this->denormalize($data['show']);

        return new ShowsResponse($shows);
    }

    /**
     * Denormalize shows
     *
     * @param array $items
     * @return array
     */
    protected function denormalize(array $items)
    {
        $shows = [];

        foreach ($items as $show) {
            $show = $this->denormalizeShow($show);
            $shows[] = $show;
        }

        return $shows;
    }
}
