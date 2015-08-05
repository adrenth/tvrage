<?php

require '../vendor/autoload.php';

$cache = new \Doctrine\Common\Cache\FilesystemCache(sys_get_temp_dir());

$client = new Adrenth\Tvrage\Client($cache);
$client->search('top gear');
