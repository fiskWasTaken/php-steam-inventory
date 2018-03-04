<?php

namespace SteamInventory\Entity;

/**
 * Class Description
 * @package SteamInventory\Entity
 * @property-read int classid
 * @property-read int appid
 * @property-read int instanceid
 * @property-read int currency
 * @property-read string background_color
 * @property-read string icon_url
 * @property-read string icon_url_large
 * @property-read int tradable
 * @property-read int marketable
 * @property-read array tags
 * @property-read array descriptions
 * @property-read string market_name
 * @property-read string market_hash_name
 * @property-read string type
 * @property-read int commodity
 * @property-read string name
 * @property-read string name_color
 */
class Description extends Model {
    public function isTradable(): bool {
        return $this->tradable === 1;
    }

    public function isMarketable(): bool {
        return $this->marketable === 1;
    }

    public function isCommodity(): bool {
        return $this->commodity === 1;
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array {
        return array_map(function ($doc) {
            return new Tag($doc);
        }, $this->tags ?? []);
    }

    /**
     * @return ExtraDescription[]
     */
    public function getDescriptions(): array {
        return array_map(function ($doc) {
            return new ExtraDescription($doc);
        }, $this->descriptions ?? []);
    }
}