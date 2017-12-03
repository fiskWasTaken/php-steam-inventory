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
 *
 * Store the result to a variable, because getFirstPage is independent of the
 * iterator behaviour otherwise offered by this library.
 */
$page = $inventory->getFirstPage();

print("{$page->getPageSize()} items in inventory.\n");

print("First item is: {$page->getItem(0)->getDescription()['name']}\n");
print("Fifth item is: {$page->getItem(4)->getDescription()['name']}\n");