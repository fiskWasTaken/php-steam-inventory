<?php
/**
 * Created by PhpStorm.
 * User: fisk
 * Date: 03/12/17
 * Time: 09:34
 */

namespace SteamInventory\Transport;


use SteamInventory\Request\InventoryResponseInterface;
use SteamInventory\Request\InventoryRequestInterface;

interface InventoryTransportInterface {
    /**
     * Get an accompanying response for an inventory request.
     *
     * @param InventoryRequestInterface $request
     * @return null|InventoryResponseInterface
     */
    public function execute(InventoryRequestInterface $request);
}