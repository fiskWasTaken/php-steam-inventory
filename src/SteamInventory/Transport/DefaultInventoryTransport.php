<?php

namespace SteamInventory\Transport;


use GuzzleHttp\Client;
use SteamInventory\Request\InventoryRequestInterface;
use SteamInventory\Request\InventoryResponse;
use SteamInventory\Request\InventoryResponseInterface;

class DefaultInventoryTransport implements InventoryTransportInterface {
    private $client;

    /**
     * Default transport constructor.
     * @param string $base_uri
     */
    public function __construct($base_uri = 'http://steamcommunity.com') {
        $this->client = new Client([
            'base_uri' => $base_uri
        ]);
    }

    /**
     * @param InventoryRequestInterface $request
     * @return null|InventoryResponseInterface
     */
    public function sendRequest(InventoryRequestInterface $request) {
        $uri = "/inventory/{$request->getSteamid()}/{$request->getAppid()}/{$request->getContextId()}";

        $query = [
            'l' => $request->getLanguage(),
            'count' => $request->getCount()
        ];

        if ($request->getStartingAssetId()) {
            $query['start_assetid'] = $request->getStartingAssetId();
        }

        $response = $this->client->get($uri, [
            'query' => $query
        ]);

        if ($response->getStatusCode() == 200) {
            return new InventoryResponse($response->getBody());
        }

        return null;
    }
}