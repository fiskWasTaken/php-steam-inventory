<?php

namespace SteamInventory\Transport;


use SteamInventory\Request\InventoryRequestInterface;
use SteamInventory\Request\InventoryResponseInterface;

interface InventoryTransportInterface {
    /**
     * Get an accompanying response for an inventory request.
     *
     * @param InventoryRequestInterface $request
     * @return InventoryResponseInterface
     */
    public function execute(InventoryRequestInterface $request): InventoryResponseInterface;
}