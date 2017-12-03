<?php

namespace SteamInventory;


use SteamInventory\Request\InventoryRequest;
use SteamInventory\Request\InventoryResponseInterface;

class InventoryContainer {
    private $query;
    private $client;

    /**
     * @var InventoryResponseInterface
     */
    private $currentPage;

    public function __construct(Client $client, InventoryQuery $query) {
        $this->client = $client;
        $this->query = $query;
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }

    /**
     * Will advance the current page forward.
     */
    public function nextPage() {
        $this->currentPage = $this->getNextPage();
    }

    /**
     * @return InventoryResponseInterface|null
     */
    private function getNextPage() {
        $transport = $this->client->getTransport();

        if ($this->currentPage) {
            $lastAssetId = $this->currentPage->getLastAssetId();

            if (!$lastAssetId) {
                // this is the last page.
                return null;
            }
        } else {
            // no page yet loaded -- will be getting first page
            $lastAssetId = 0;
        }

        $req = $this->buildUriRequest($lastAssetId);
        return $transport->execute($req);
    }

    private function buildUriRequest($lastAssetId = null) {
        $config = $this->client->getConfiguration();

        return new InventoryRequest([
            'steamid' => $this->query->getSteamid(),
            'appid' => $this->query->getAppid(),
            'contextid' => $this->query->getContextId(),
            'count' => $config->getPageSize(),
            'start_assetid' => $lastAssetId,
            'language' => $config->getLanguage()
        ]);
    }

    public function getItems(): ItemIterator {
        return new ItemIterator($this);
    }
}