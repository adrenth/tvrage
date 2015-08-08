<?php

namespace Adrenth\Tvrage\Response;

/**
 * Class ResponseHandler
 *
 * @category Tvrage
 * @package  Adrenth\Tvrage\Response
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://github.com/adrenth/tvrage
 */
abstract class ResponseHandler
{
    /**
     * Response Data
     *
     * @type mixed
     */
    protected $data;

    /**
     * RAW Data
     *
     * @type string
     */
    protected $rawData;

    /**
     * Construct
     *
     * @param string $rawData Raw Response Data
     */
    public function __construct($rawData)
    {
        $this->rawData = $rawData;
        $this->data = $this->deserialize();
    }

    /**
     * Get Data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get RAW data
     *
     * @return string
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    /**
     * Deserialize data to object(s)
     *
     * @return mixed
     */
    abstract public function deserialize();
}
