<?php
require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json');

use Patreon\PatreonAPI;

$api = new PatreonAPI("ACCESS TOKEN");
var_dump($api->getAllActivePatreons());