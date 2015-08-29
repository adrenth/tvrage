<?php

namespace Adrenth\Tests\Tvrage;

use Adrenth\Tests\AdrenthTestCase;
use Adrenth\Tests\Tvrage\Client\MockClient;
use Adrenth\Tvrage\Aka;
use Adrenth\Tvrage\Client;
use Adrenth\Tvrage\DetailedShow;
use Adrenth\Tvrage\Episode;
use Adrenth\Tvrage\Network;
use Adrenth\Tvrage\Response\EpisodeResponse;
use Adrenth\Tvrage\Response\SeasonsResponse;
use Adrenth\Tvrage\Response\ShowResponse;
use Adrenth\Tvrage\Response\ShowsResponse;
use Adrenth\Tvrage\Season;
use Adrenth\Tvrage\Show;
use Doctrine\Common\Cache\VoidCache;

/**
 * Class ClientTest
 *
 * @category Tvrage
 * @package  Adrenth\Tests\Tvrage
 * @author   Alwin Drenth <adrenth@gmail.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     https://github.com/adrenth/tvrage
 */
class ClientTest extends AdrenthTestCase
{
    /** @type Client */
    private $client;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $cache = new VoidCache();
        $this->client = new MockClient($cache);
    }

    public function testSearch()
    {
        $response = $this->client->search('buffy');

        $this->assertInstanceOf(ShowsResponse::class, $response);
        $this->assertCount(3, $response->getShows());
        $this->assertTrue($response->hasShows());
        $this->assertContainsOnlyInstancesOf(Show::class, $response->getShows());

        /** @type Show $show1 */
        list($show1,,) = $response->getShows();

        $this->showTest($show1);
    }

    public function testFullSearch()
    {
        $response = $this->client->fullSearch('buffy');

        $this->assertInstanceOf(ShowsResponse::class, $response);
        $this->assertCount(3, $response->getShows());
        $this->assertTrue($response->hasShows());
        $this->assertContainsOnlyInstancesOf(DetailedShow::class, $response->getShows());

        /** @type DetailedShow $show1 */
        list($show1,,) = $response->getShows();

        $this->detailedShowTest($show1);
    }

    public function testShowInfo()
    {
        $response = $this->client->showInfo(2930);

        $this->assertInstanceOf(ShowResponse::class, $response);
        $this->assertInternalType('bool', $response->hasShow());
        $this->assertTrue($response->hasShow());

        /** @type DetailedShow $show */
        $show = $response->getShow();

        $this->detailedShowTest($show);
        $this->assertEquals('GMT-5 +DST', $show->getTimeZone());
    }

    public function testFullShowInfo()
    {
        $response = $this->client->fullShowInfo(2930);

        $this->assertInstanceOf(ShowResponse::class, $response);
        $this->assertInternalType('bool', $response->hasShow());
        $this->assertTrue($response->hasShow());

        /** @type DetailedShow $show */
        $show = $response->getShow();

        $this->detailedShowTest($show);
    }

    public function testEpisodeList()
    {
        $response = $this->client->episodeList(2930);

        $this->assertInstanceOf(SeasonsResponse::class, $response);
        $this->assertInternalType('bool', $response->hasSeasons());
        $this->assertTrue($response->hasSeasons());
        $this->assertContainsOnlyInstancesOf(Season::class, $response->getSeasons());

        /** @type Season $season */
        $season = $response->getSeasons()[0];
        $this->assertEquals(1, $season->getNumber());

        $this->assertInternalType('bool', $season->hasEpisodes());
        $this->assertTrue($season->hasEpisodes());
        $this->assertContainsOnlyInstancesOf(Episode::class, $season->getEpisodes());

        /** @type Episode $episode */
        $episode = $season->getEpisodes()[0];

        $this->assertEquals(1, $episode->getNumber());
        $this->assertEquals('Welcome to the Hellmouth (1)', $episode->getTitle());
        $this->assertEquals('1997-03-10', $episode->getAirdate());
        $this->assertEquals('http://www.tvrage.com/Buffy_The_Vampire_Slayer/episodes/28077', $episode->getLink());
    }

    public function testEpisodeInfo()
    {
        $response = $this->client->episodeInfo(2930, 1, 1);

        $this->assertInstanceOf(EpisodeResponse::class, $response);
        $this->assertInternalType('bool', $response->hasEpisode());
        $this->assertInternalType('bool', $response->hasLatestEpisode());

        $this->assertInstanceOf(Episode::class, $response->getEpisode());
        $this->assertInstanceOf(Episode::class, $response->getLatestEpisode());
    }

    public function showTest(Show $test)
    {
        $this->assertEquals(2930, $test->getShowId());
        $this->assertInternalType('int', $test->getShowId());
        $this->assertEquals('Buffy the Vampire Slayer', $test->getName());
        $this->assertInternalType('string', $test->getName());
        $this->assertEquals('http://tvrage.com/Buffy_The_Vampire_Slayer', $test->getLink());
        $this->assertInternalType('string', $test->getLink());
        $this->assertEquals('US', $test->getCountry());
        $this->assertInternalType('string', $test->getCountry());
        $this->assertTrue($test->isEnded());
        $this->assertInternalType('bool', $test->isEnded());
        $this->assertEquals(7, $test->getSeasonCount());
        $this->assertInternalType('int', $test->getSeasonCount());
        $this->assertEquals('Ended', $test->getStatus());
        $this->assertInternalType('string', $test->getStatus());
        $this->assertEquals('Scripted', $test->getClassification());
        $this->assertInternalType('string', $test->getClassification());
        $this->assertInternalType('array', $test->getGenres());
        $this->assertContainsOnly('string', $test->getGenres());
        $this->assertContains('Comedy', $test->getGenres());
    }

    public function detailedShowTest(DetailedShow $show)
    {
        $this->assertInstanceOf(Show::class, $show);
        $this->assertInstanceOf(DetailedShow::class, $show);

        $this->assertEquals(2930, $show->getShowId());
        $this->assertInternalType('int', $show->getShowId());
        $this->assertEquals('Buffy the Vampire Slayer', $show->getName());
        $this->assertInternalType('string', $show->getName());
        $this->assertEquals('http://tvrage.com/Buffy_The_Vampire_Slayer', $show->getLink());
        $this->assertInternalType('string', $show->getLink());
        $this->assertEquals(7, $show->getSeasonCount());
        $this->assertInternalType('int', $show->getSeasonCount());
        $this->assertTrue($show->isEnded());
        $this->assertInternalType('bool', $show->isEnded());
        $this->assertEquals('Ended', $show->getStatus());
        $this->assertInternalType('string', $show->getStatus());
        $this->assertEquals('Scripted', $show->getClassification());
        $this->assertInternalType('string', $show->getClassification());
        $this->assertInternalType('array', $show->getGenres());
        $this->assertContainsOnly('string', $show->getGenres());
        $this->assertContains('Comedy', $show->getGenres());
        $this->assertCount(7, $show->getGenres());
        $this->assertContains('Comedy', $show->getGenres());
        $this->assertEquals(60, $show->getRuntime());
        $this->assertInternalType('int', $show->getRuntime());
        $this->assertEquals('20:00', $show->getAirtime());
        $this->assertEquals('Tuesday', $show->getAirday());
        $this->assertContainsOnlyInstancesOf(Aka::class, $show->getAkas());

        /** @type Aka $aka */
        $aka = $show->getAkas()[0];

        $this->assertEquals('Buffy & vampyrerna', $aka->getTitle());
        $this->assertEquals('SE', $aka->getCountry());
        $this->assertNull($aka->getAttr());

        /** @type Network $network */
        $network = $show->getNetwork();

        $this->assertInstanceOf(Network::class, $network);
        $this->assertEquals('UPN', $network->getName());
        $this->assertEquals('US', $network->getCountry());

        $this->assertInternalType('bool', $show->hasSeasons());

        if (!$show->hasSeasons()) {
            return;
        }

        $this->assertContainsOnlyInstancesOf(Season::class, $show->getSeasons());
        $this->assertEquals($show->getSeasonCount(), count($show->getSeasons()));
    }
}
