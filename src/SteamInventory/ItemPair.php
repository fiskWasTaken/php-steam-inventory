<?php

namespace SteamInventory;

/**
 * Class ItemPair
 * @package SteamInventory
 *
 * An entity that pairs an asset with its description.
 */
class ItemPair {
    private $asset;
    private $description;

    public function __construct(array $asset, array $description) {
        $this->asset = $asset;
        $this->description = $description;
    }

    /**
     * @return array
     * Get the asset information for this item.
     */
    public function getAsset(): array {
        return $this->asset;
    }

    /**
     * @return array
     * Get the associated description for this item.
     */
    public function getDescription(): array {
        return $this->description;
    }
}