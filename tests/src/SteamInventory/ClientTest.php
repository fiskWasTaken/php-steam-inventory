<?php

namespace SteamInventory;

use PHPUnit\Framework\TestCase;
use SteamInventory\Transport\GuzzleInventoryTransport;

class ClientTest extends TestCase {
    /**
     * @var Client
     */
    private $instance;

    public function setUp() {
        $this->instance = new Client(
            new Configuration(['language' => 'klingon'])
        );
    }

    public function testInstance() {
        $this->assertEquals('klingon', $this->instance->getConfiguration()->getLanguage());
        $this->assertEquals(GuzzleInventoryTransport::class, get_class($this->instance->getTransport()));
    }
}
