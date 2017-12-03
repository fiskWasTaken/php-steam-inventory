Early release -- not done yet!

[ ] Add extra code coverage in test cases.

[ ] Finalised interfaces.

# steam-inventory

Dealing with Steam's inventory data can be a bit of a PITA. This PHP library 
makes an attempt to simplify the process, and provides memory management
techniques that make parsing inventories with thousands of items a little more
 manageable.
 
It is not uncommon for Steam inventories to have over 2,000 items in them. 
This is a lot of data to parse at the same time!

This library comes from the experience of someone who has used these 
APIs for years. I hope this becomes useful for your PHP project.

## What's inside

* PHP bindings for the Steam community inventory APIs.
* Seamless, configurable iteration of paginated inventory data.
* Pairing of assets with their item descriptions.
* A simple inventory transport that implements `InventoryTransportInterface`. 
  You may swap this out if you need to change how you make web requests.
* Tests, to make sure this library stays sane.
  
Please note that this library does not handle exceptions thrown from network
errors.

## Configuration

`Configuration` accepts the following keys:

* `language` -- the language used for description strings. Defaults to `english`.
  Note that this isn't a guarantee, as some games may not be subject to i18n.
* `page_size` -- the number of items to retrieve per request. Defaults to 5000.