<?php

namespace SteamInventory\Request;

use PHPUnit\Framework\TestCase;

class InventoryRequestTest extends TestCase {
    /**
     * @var InventoryRequest
     */
    private $instance;

    public function setUp(): void {
        $this->instance = new InventoryRequest([
            'steamid' => "76561198012598620",
            'appid' => 440,
            'contextid' => 2,
            'count' => 500,
            'start_assetid' => null,
            'language' => 'german'
        ]);
    }

    public function testInstance() {
        $this->assertEquals("76561198012598620", $this->instance->getSteamid());
        $this->assertEquals(440, $this->instance->getAppid());
        $this->assertEquals(2, $this->instance->getContextId());
        $this->assertEquals(500, $this->instance->getCount());
        $this->assertEquals(null, $this->instance->getStartingAssetId());
        $this->assertEquals("german", $this->instance->getLanguage());
    }
}
