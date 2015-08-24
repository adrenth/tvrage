<?php

namespace Adrenth\Tests\Tvrage;

use Adrenth\Tests\AdrenthTestCase;
use Adrenth\Tvrage\Aka;

/**
 * Class AkaTest
 *
 * @package Adrenth\Tests\Tvrage
 */
class AkaTest extends AdrenthTestCase
{
    /**
     * @type Aka
     */
    private $aka;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->aka = new Aka();
    }

    public function testSetters()
    {
        $this->aka->setTitle('A title');
        $this->assertEquals('A title', $this->aka->getTitle());

        $this->aka->setAttr('Attribute');
        $this->assertEquals('Attribute', $this->aka->getAttr());

        $this->aka->setCountry('NL');
        $this->assertEquals('NL', $this->aka->getCountry());
    }
}
