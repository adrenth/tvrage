<?php

namespace Adrenth\Tests\Tvrage\Client;

use Adrenth\Tvrage\Client;

/**
 * Class MockClient
 *
 * @package Adrenth\Tests\Tvrage\Client
 */
class MockClient extends Client
{
    /**
     * @inheritdoc
     */
    protected function performApiCall($path, array $query = [])
    {
        switch ($path) {
            case self::API_PATH_SEARCH:
                // ?show=buffy
                return $this->getFileContents('test_search.xml');
                break;
            case self::API_PATH_SEARCH_FULL:
                // ?show=buffy
                return $this->getFileContents('test_full_search.xml');
                break;
            case self::API_PATH_SHOW_INFO:
                // ?sid=2930
                return $this->getFileContents('test_showinfo.xml');
                break;
            case self::API_PATH_SHOW_INFO_FULL:
                // ?sid=2930
                return $this->getFileContents('test_full_show_info.xml');
                break;
            case self::API_PATH_EPISODE_INFO:
                // ?sid=2930&ep=2x04
                return $this->getFileContents('test_episodeinfo.xml');
                break;
            case self::API_PATH_EPISODE_LIST:
                // ?sid=2930
                return $this->getFileContents('test_episode_list.xml');
                break;
        }

        return '';
    }

    /**
     * Read contents of file and return it
     *
     * @param string $filename
     * @return string
     */
    private function getFileContents($filename)
    {
        $path = realpath(__DIR__ . DIRECTORY_SEPARATOR . $filename);

        $data = file_get_contents($path);

        if ($data === false) {
            $data = '';
        }

        return $data;
    }
}
