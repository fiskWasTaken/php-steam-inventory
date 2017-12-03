<?php

namespace SteamInventory;


use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use SteamInventory\Request\InventoryResponse;

class ResponseTest extends TestCase {
    private function getResponse($filename) {
        $resource = fopen($filename, 'r');
        $stream = new Stream($resource);
        return new InventoryResponse($stream);
    }

    public function testPrivateInventory() {
        $resp = $this->getResponse('tests/private_inventory.json');
        $this->assertEquals(true, $resp->isPrivate());
        $this->assertEquals(null, $resp->getItem(0));
    }

    public function testNonexistentInventory() {
        $resp = $this->getResponse('tests/nonexistent_inventory.json');
        $this->assertEquals(null, $resp->getItem(0));
    }

    public function testTowerUniteInventory() {
        $resp = $this->getResponse('tests/tower_unite_inventory.json');
        // todo
    }
}