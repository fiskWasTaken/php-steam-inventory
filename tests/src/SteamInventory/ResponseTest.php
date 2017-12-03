<?php

namespace SteamInventory;


use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use SteamInventory\Request\InventoryResponse;

class ResponseTest extends TestCase {
    public function testPrivateInventory() {
        $resp = $this->getResponse('./tests/private_inventory.json');
        $this->assertEquals(true, $resp->isPrivate());
        $this->assertEquals(null, $resp->getItem(0));
    }

    private function getResponse($filename) {
        $resource = fopen($filename, 'r');
        $stream = new Stream($resource);
        return new InventoryResponse($stream);
    }

    public function testEmptyInventory() {
        $resp = $this->getResponse('./tests/empty_inventory.json');
        $this->assertEquals(false, $resp->isPrivate());
        $this->assertEquals(null, $resp->getItem(0));
    }

    public function testErrorInventory() {
        $resp = $this->getResponse('./tests/internal_error.json');
        $this->assertEquals(false, $resp->isSuccess());
        $this->assertEquals(false, $resp->isPrivate());
        $this->assertEquals("EYldRefreshAppIfNecessary failed with EResult 55", $resp->getError());
        // todo
    }
}