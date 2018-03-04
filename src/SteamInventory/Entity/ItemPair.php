<?php

namespace SteamInventory\Entity;

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
     * @return Asset
     * Get the asset information for this item.
     */
    public function getAsset(): Asset {
        return new Asset($this->asset);
    }

    /**
     * @return Description
     * Get the associated description for this item.
     */
    public function getDescription(): Description {
        return new Description($this->description);
    }
}