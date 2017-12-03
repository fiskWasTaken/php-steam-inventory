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

$response = $client->getInventory(new \SteamInventory\InventoryQuery(
    "76561198012598620",
    440
));

$i = 0;

foreach ($response->getItems() as $item) {
    print_r(
        sprintf(
            "This asset's ID is: %d. This page's last asset ID is: %d.\n",
            $item->getAsset()['assetid'],
            $response->getCurrentPage()->getLastAssetId()
        )
    );

    // break after a few items are fetched
    if ($i++ == 10)
        break;
}