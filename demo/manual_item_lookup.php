<?php

include_once __DIR__ . '/../vendor/autoload.php';

$client = new \SteamInventory\Client();

$inventory = $client->getInventory(new \SteamInventory\InventoryQuery(
    "76561198012598620",
    440
));

/*
 * If you are not going to use the item iterator, but you need response information,
 * you will have to iterate through pages manually.
 */
$inventory->nextPage();

print("{$inventory->getCurrentPage()->getPageSize()} items in inventory.\n");

print("First item is: {$inventory->getCurrentPage()->getItem(0)->getDescription()['name']}\n");
print("Fifth item is: {$inventory->getCurrentPage()->getItem(4)->getDescription()['name']}\n");