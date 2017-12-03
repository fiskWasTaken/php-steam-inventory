<?php

namespace SteamInventory\Transport;


use GuzzleHttp\Client;
use SteamInventory\Request\InventoryRequestInterface;
use SteamInventory\Request\InventoryResponse;
use SteamInventory\Request\InventoryResponseInterface;

class GuzzleInventoryTransport implements InventoryTransportInterface {
    private $client;

    /**
     * Default transport constructor.
     *
     * A custom Guzzle HTTP client may be passed. If this is done, the base_uri
     * should be set to http://steamcommunity.com (or your forward proxy).
     *
     * @param Client $client
     */
    public function __construct($client = null) {
        if (!$client) {
            $client = new Client([
                'base_uri' => 'http://steamcommunity.com'
            ]);
        }

        $this->client = $client;
    }

    /**
     * @param InventoryRequestInterface $request
     * @return null|InventoryResponseInterface
     */
    public function execute(InventoryRequestInterface $request) {
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