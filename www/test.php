<?php

require '../vendor/autoload.php';

$cache = new \Doctrine\Common\Cache\FilesystemCache(sys_get_temp_dir());
var_dump(sys_get_temp_dir());

//$cache = new \Doctrine\Common\Cache\ArrayCache();

$client = new Adrenth\Tvrage\Client($cache);

//$response = $client->search('top gear');
//$response = $client->fullSearch('the following');
//$response = $client->fullSearch('lost');
//$response = $client->fullSearch('ray donovan');
//$response = $client->showInfo(2930);
$response = $client->fullShowInfo(2930);

echo '<pre>';
print_r($response);