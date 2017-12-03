<?php
/**
 * Created by PhpStorm.
 * User: fisk
 * Date: 03/12/17
 * Time: 09:56
 */

namespace SteamInventory\Request;


use SteamInventory\ItemPair;

interface InventoryResponseInterface {
    /**
     * @return int|null
     */
    public function getLastAssetId();

    /**
     * @param int $index
     * @return ItemPair|null
     */
    public function getItem(int $index);

    /**
     * @return bool
     */
    public function isPrivate(): bool;

    /**
     * @return int
     */
    public function getPageSize(): int;

    /**
     * @return int
     * Return the total number of items in the inventory.
     */
    public function getInventorySize(): int;
}