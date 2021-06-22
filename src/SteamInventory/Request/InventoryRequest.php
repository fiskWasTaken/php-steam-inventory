<?php

namespace SteamInventory\Request;

/**
 * Class InventoryRequest
 *
 * Contains data used to build the request URI/querystring.
 *
 * @package SteamInventory
 * @property string $steamid
 * @property int $appid
 * @property string $language
 * @property int $count
 * @property int $start_assetid
 */
class InventoryRequest implements InventoryRequestInterface {
    private $options = [
        'steamid' => '',
        'count' => 0,
        'appid' => 0,
        'contextid' => 0,
        'start_assetid' => 0,
        'language' => 'english'
    ];

    public function __construct($options) {
        foreach ($options as $key => $value) {
            if (!array_key_exists($key, $this->options)) {
                $errFmt = "Key %s is not an applicable option.";
                throw new \InvalidArgumentException(sprintf($errFmt, $key));
            }

            $this->options[$key] = $value;
        }
    }

    public function getLanguage(): string {
        return $this->options['language'] ?? 'english';
    }

    public function getCount(): int {
        return $this->options['count'] ?? 0;
    }

    public function getAppid(): int {
        return $this->options['appid'] ?? 0;
    }

    public function getContextId(): int {
        return $this->options['contextid'] ?? 2;
    }

    public function getStartingAssetId(): int {
        return $this->options['start_assetid'] ?? 0;
    }

    public function getSteamid(): string {
        return $this->options['steamid'] ?? "";
    }
}