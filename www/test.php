<?php

require '../vendor/autoload.php';

//$cache = new \Doctrine\Common\Cache\FilesystemCache(sys_get_temp_dir());
$cache = new \Doctrine\Common\Cache\ArrayCache();

$client = new Adrenth\Tvrage\Client($cache);
//$response = $client->search('top gear');
//var_dump($response);

//$response = $client->fullSearch('the following');
//$response = $client->fullSearch('lost');
$response = $client->fullSearch('ray donovan');
echo '<pre>';
print_r($response);