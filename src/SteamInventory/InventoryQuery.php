<?php
/**
 * Created by PhpStorm.
 * User: fisk
 * Date: 01/12/17
 * Time: 22:03
 */

namespace SteamInventory;

/**
 * Class InventoryContext
 * @package SteamInventory
 *
 * An inventory query that wraps steamid, appid and contextid.
 */
class InventoryQuery {
    private $steamid;
    private $appid;
    private $contextId;

    public function __construct(string $steamid, int $appid, int $contextId = 2) {
        $this->steamid = $steamid;
        $this->appid = $appid;
        $this->contextId = $contextId;
    }

    public function getSteamid(): string {
        return $this->steamid;
    }

    public function getAppid(): int {
        return $this->appid;
    }

    public function getContextId(): int {
        return $this->contextId;
    }
}