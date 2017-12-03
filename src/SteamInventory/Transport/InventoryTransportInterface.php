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
     * @param InventoryRequestInterface $request
     * @return null|InventoryResponseInterface
     */
    public function sendRequest(InventoryRequestInterface $request);
}