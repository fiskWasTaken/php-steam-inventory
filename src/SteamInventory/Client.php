<?php

namespace SteamInventory;

use SteamInventory\Transport\DefaultInventoryTransport;
use SteamInventory\Transport\InventoryTransportInterface;

class Client {
    private $configuration;
    private $transport;

    public function __construct(
        Configuration $configuration = null,
        InventoryTransportInterface $transport = null
    ) {
        if (!$configuration)
            $configuration = new Configuration();

        $this->configuration = $configuration;

        if (!$transport)
            $transport = new DefaultInventoryTransport();

        $this->transport = $transport;
    }

    public function getConfiguration(): Configuration {
        return $this->configuration;
    }

    public function getTransport(): InventoryTransportInterface {
        return $this->transport;
    }

    public function getInventory(InventoryQuery $query) {
        return new InventoryContainer(
            $this,
            $query
        );
    }
}