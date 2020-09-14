# PatreonAPIOverCurl
Just the patreon api for php over curl

Installing:
> composer require xsirblockx/patreonapi

Usage:

```php
//Usage
<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Patreon\PatreonAPI;

$api = new PatreonAPI("ACCESS TOKEN");

//Get campaign id
echo $api->getCampaignID()

//Get all patreons
var_dump($api->getAllPatreons());

//Get all active patreons
var_dump($api->getAllPatreons());

```
