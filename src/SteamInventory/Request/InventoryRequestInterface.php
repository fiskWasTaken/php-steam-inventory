<?php

namespace SteamInventory\Request;


interface InventoryRequestInterface {
    public function getLanguage(): string;

    public function getCount(): int;

    public function getAppid(): int;

    public function getContextId(): int;

    public function getStartingAssetId(): int;

    public function getSteamid(): string;
}