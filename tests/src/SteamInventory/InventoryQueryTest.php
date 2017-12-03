<?php

namespace SteamInventory;

use PHPUnit\Framework\TestCase;

class InventoryQueryTest extends TestCase {
    /**
     * @var InventoryQuery
     */
    private $instance;

    public function setUp() {
        $this->instance = new InventoryQuery("76561198012598620", 440);
    }

    public function testInstance() {
        // 2 is the default contextid
        $this->assertEquals(2, $this->instance->getContextId());
        $this->assertEquals(440, $this->instance->getAppid());
        $this->assertEquals("76561198012598620", $this->instance->getSteamid());
    }
}
