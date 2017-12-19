# php-steam-inventory  ![Travis](https://api.travis-ci.org/fiskie/php-steam-inventory.svg?branch=master)

It is not uncommon for thousands of items to exist in a single Steam inventory, 
and this can mean a lot of data to parse at the same time! This PHP library aims
to provide a simple interface to the Steam Community inventory APIs, while
making use of paginated requests to keep inventories manageable in low-memory
environments.

This library comes from the experience of someone who has used these 
APIs for years. I hope this becomes useful for your PHP project.

## Composer

```
composer require fisk/steam-inventory
```

## Quick start

```
<php
$client = new \SteamInventory\Client();

$inventory = $client->getInventory(new \SteamInventory\InventoryQuery(
    "76561198012598620", // steamid
    440                  // appid
));

foreach ($inventory->getItems() as $item) {
    $asset = $item->getAsset();
    $description = $item->getDescription();
    (...)
}
```

## What's inside

* PHP bindings for the Steam community inventory APIs.
* Seamless, configurable iteration of paginated inventory data.
* Pairing of assets with their item descriptions.
* A simple inventory transport that implements `InventoryTransportInterface`. 
  You may swap this out if you need to change how you make web requests.
* Tests, to make sure this library stays sane.

By default, the items fetched per page is enough to fetch a whole inventory.
This is a trade-off depending on your use case; if you make too many requests,
you may be subject to hitting request limits. On the other hand, you may run
into memory issues if you try to process too many items at the same time.
  
Please note that this library does not handle exceptions thrown from network
errors.

## Configuration

`Configuration` accepts the following keys:

* `language` -- the language used for description strings. Defaults to `english`.
  Note that this isn't a guarantee, as some games may not be subject to i18n.
* `page_size` -- the number of items to retrieve per request. Defaults to 5000.
