<?php

namespace SteamInventory\Transport;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
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
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client = null) {
        if (!$client) {
            $client = new Client([
                'base_uri' => 'http://steamcommunity.com'
            ]);
        }

        $this->client = $client;
    }

    /**
     * @param InventoryRequestInterface $request
     * @return InventoryResponseInterface
     */
    public function execute(InventoryRequestInterface $request): InventoryResponseInterface {
        $uri = "/inventory/{$request->getSteamid()}/{$request->getAppid()}/{$request->getContextId()}";

        $query = [
            'l' => $request->getLanguage(),
            'count' => $request->getCount()
        ];

        if ($request->getStartingAssetId()) {
            $query['start_assetid'] = $request->getStartingAssetId();
        }

        try {
            $response = $this->client->get($uri, [
                'query' => $query
            ]);

            return new InventoryResponse($response->getBody());
        } catch (ClientException $e) {
            $response = $e->getResponse();
            // 403 exceptions are likely to be private inventories, so capture those.
            if ($response->getStatusCode() == 403) {
                return new InventoryResponse($e->getResponse()->getBody());
            }

            // Pass exception on if it's not 403
            throw $e;
        }
    }
}