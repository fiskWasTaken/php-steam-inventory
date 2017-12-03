<?php


namespace SteamInventory\Transport;


use GuzzleHttp\Psr7\Stream;
use SteamInventory\Request\InventoryRequestInterface;
use SteamInventory\Request\InventoryResponse;

class MockInventoryTransport implements InventoryTransportInterface {
    public function execute(InventoryRequestInterface $request) {
        $resource = fopen('./tests/tower_unite_inventory.json', 'r');
        $stream = new Stream($resource);
        return new InventoryResponse($stream);
    }
}