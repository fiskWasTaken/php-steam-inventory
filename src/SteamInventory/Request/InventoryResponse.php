<?php

namespace SteamInventory\Request;

use Psr\Http\Message\StreamInterface;
use SteamInventory\Entity\ItemPair;

/**
 * Class InventoryResponse
 *
 * An abstract representation of an inventory response.
 *
 * @package SteamInventory
 */
class InventoryResponse implements InventoryResponseInterface {
    private $data;
    private $descriptionHash;

    /**
     * InventoryResponse constructor.
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream) {
        $this->data = json_decode($stream, true);
        $this->cacheDescriptions();
    }

    /**
     * Hashes the descriptions to reduce lookup time.
     */
    private function cacheDescriptions() {
        foreach ($this->data['descriptions'] ?? [] as $desc) {
            $key = $this->getDescriptionKey($desc);
            $this->descriptionHash[$key] = $desc;
        }
    }

    private function getDescriptionKey(array $desc) {
        return $desc['classid'] . '_' . $desc['instanceid'];
    }

    /**
     * @return \Generator|ItemPair[]
     */
    public function getItems(): \Generator {
        $count = $this->getPageSize();

        for ($i = 0; $i < $count; $i++)
            yield $this->getItem($i);
    }

    /**
     * @return int
     * Return the number of items on this page.
     */
    public function getPageSize(): int {
        return count($this->data['assets'] ?? []);
    }

    /**
     * @param int $index
     * @return null|ItemPair
     */
    public function getItem(int $index) {
        $asset = $this->data['assets'][$index] ?? null;

        if (!$asset)
            return null;

        /*
         * We should never, ever be in a state where we can't
         * fetch the description key.
         */
        $key = $this->getDescriptionKey($asset);
        $description = $this->descriptionHash[$key] ?? null;

        return new ItemPair($asset, $description);
    }

    /**
     * @return bool
     * A private inventory will literally be a string value of "null".
     * This is still valid JSON, no worries.
     */
    public function isPrivate(): bool {
        return $this->data === null;
    }

    /**
     * @return int|null
     * Returns the last assetid.
     * This is used for pagination of inventory responses.
     * This is null if there are no more items after the current page.
     */
    public function getLastAssetId() {
        return $this->data['last_assetid'] ?? null;
    }

    /**
     * @return bool
     * Exists if there are more items after this page.
     * Redundant, as it's only really set alongside last_assetid.
     */
    public function hasMoreItems(): bool {
        return ($this->data['more_items'] ?? 0) === 1;
    }

    /**
     * @return int
     * Return the total number of items in the inventory.
     */
    public function getInventorySize(): int {
        return $this->data['total_inventory_count'] ?? 0;
    }

    /**
     * If success is ever set, it should be 1.
     * If not, there may be an internal error.
     *
     * @return bool
     */
    public function isSuccess(): bool {
        return ($this->data['success'] ?? 0) === 1;
    }

    /**
     * @return int
     * I have no idea what this is.
     */
    public function getRwgrsn() {
        return $this->data['rwgrsn'] ?? null;
    }

    /**
     * If success is nonexistent, there may be an internal error.
     * Check this value to see if a string was returned.
     *
     * @return string|null
     */
    public function getError() {
        return $this->data['error'] ?? null;
    }
}