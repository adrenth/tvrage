<?php


namespace Adrenth\Tests\Tvrage;

use Adrenth\Tests\AdrenthTestCase;
use Adrenth\Tests\Tvrage\Client\MockClient;
use Adrenth\Tvrage\Aka;
use Adrenth\Tvrage\Client;
use Adrenth\Tvrage\DetailedShow;
use Adrenth\Tvrage\Network;
use Adrenth\Tvrage\Response\ShowsResponse;
use Adrenth\Tvrage\Show;
use Doctrine\Common\Cache\VoidCache;

/**
 * Class ClientTest
 *
 * @package Adrenth\Tests\Tvrage
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

        $this->assertEquals(2930, $show1->getShowId());
        $this->assertInternalType('int', $show1->getShowId());
        $this->assertEquals('Buffy the Vampire Slayer', $show1->getName());
        $this->assertInternalType('string', $show1->getName());
        $this->assertEquals('http://www.tvrage.com/Buffy_The_Vampire_Slayer', $show1->getLink());
        $this->assertInternalType('string', $show1->getLink());
        $this->assertEquals('US', $show1->getCountry());
        $this->assertInternalType('string', $show1->getCountry());
        $this->assertEquals(1997, $show1->getStarted());
        $this->assertInternalType('int', $show1->getStarted());
        $this->assertEquals(2003, $show1->getEnded());
        $this->assertInternalType('int', $show1->getEnded());
        $this->assertEquals(7, $show1->getSeasonCount());
        $this->assertInternalType('int', $show1->getSeasonCount());
        $this->assertEquals('Ended', $show1->getStatus());
        $this->assertInternalType('string', $show1->getStatus());
        $this->assertEquals('Scripted', $show1->getClassification());
        $this->assertInternalType('string', $show1->getClassification());
        $this->assertInternalType('array', $show1->getGenres());
        $this->assertContainsOnly('string', $show1->getGenres());
        $this->assertContains('Comedy', $show1->getGenres());
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

        $this->assertInstanceOf(Network::class, $show1->getNetwork());
        $this->assertEquals('UPN', $show1->getNetwork()->getName());
        $this->assertEquals('US', $show1->getNetwork()->getCountry());
        $this->assertEquals('20:00', $show1->getAirtime());
        $this->assertEquals('Tuesday', $show1->getAirday());

        $this->assertContainsOnlyInstancesOf(Aka::class, $show1->getAkas());

        /** @type Aka $aka */
        $aka = $show1->getAkas()[0];

        $this->assertEquals('Buffy & vampyrerna', $aka->getTitle());
        $this->assertEquals('SE', $aka->getCountry());
        $this->assertNull($aka->getAttr());
    }
}
