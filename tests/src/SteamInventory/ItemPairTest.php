<?php

namespace SteamInventory;

use PHPUnit\Framework\TestCase;

class ItemPairTest extends TestCase {
    /**
     * @var ItemPair
     */
    private $instance;

    public function setUp() {
        $this->instance = new ItemPair([
            'appid' => 1105,
            'contextid' => 2,
            'assetid' => '123456',
            'classid' => '12345678',
            'instanceid' => '0',
            'amount' => 1
        ], [
            'appid' => 1105,
            'classid' => '12345678',
            'instanceid' => '0',
            'name' => "Sneed's Feed and Seed"
        ]);
    }

    public function testInstance() {
        $this->assertEquals("Sneed's Feed and Seed", $this->instance->getDescription()['name']);
        $this->assertEquals(1105, $this->instance->getAsset()['appid']);
    }
}
