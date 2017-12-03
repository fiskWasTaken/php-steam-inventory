<?php

include_once __DIR__ . '/../vendor/autoload.php';

/*
 * This example demonstrates the pagination utility of the library.
 * With a page_size set to 3, this will make several HTTP requests.
 *
 * You will probably want to set this to something higher than 3, however
 * this will help you manage memory better in scenarios where you need to
 * fetch large inventories. See what works best for you.
 */

$client = new \SteamInventory\Client(new \SteamInventory\Configuration([
    'page_size' => 3
]));

$inventory = $client->getInventory(new \SteamInventory\InventoryQuery(
    "76561198012598620",
    440
));

$i = 0;

foreach ($inventory->getItems() as $item) {
    print_r(
        sprintf(
            "Asset #%d: The last known asset ID is: %d.\n",
            $item->getAsset()['assetid'],
            $inventory->getCurrentPage()->getLastAssetId()
        )
    );

    print_r(
        sprintf(
            "Asset #%d: This item's name is \"%s\".\n",
            $item->getAsset()['assetid'],
            $item->getDescription()['name']
        )
    );

    // break after a few items are fetched
    if ($i++ == 10)
        break;
}