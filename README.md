# adrenth/tvrage

[![Build Status](https://secure.travis-ci.org/adrenth/tvrage.png?branch=master)](http://travis-ci.org/adrenth/tvrage) [![Latest Stable Version](https://poser.pugx.org/adrenth/tvrage/v/stable)](https://packagist.org/packages/adrenth/tvrage) [![Total Downloads](https://poser.pugx.org/adrenth/tvrage/downloads)](https://packagist.org/packages/adrenth/tvrage) [![Latest Unstable Version](https://poser.pugx.org/adrenth/tvrage/v/unstable)](https://packagist.org/packages/adrenth/tvrage) [![License](https://poser.pugx.org/adrenth/tvrage/license)](https://packagist.org/packages/adrenth/tvrage) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/27972813-82e6-4dc3-a168-36377084b69a/mini.png)](https://insight.sensiolabs.com/projects/27972813-82e6-4dc3-a168-36377084b69a) [![HHVM Status](http://hhvm.h4cc.de/badge/adrenth/tvrage.svg)](http://hhvm.h4cc.de/package/adrenth/tvrage)

This is an API client for the tvrage.com website. It's using the XML feeds that are publicly available. For more info visit [http://services.tvrage.com/info.php?page=main](http://services.tvrage.com/info.php?page=main).

## Installation

Install this package using Composer:

	composer require adrenth/tvrage

## Caching

Since the tvrage.com XML feeds are usually very slow I advise you to use caching. This package requires a Doctrine `Cache` instance. 

To disable caching just provide a `VoidCache` or `ArrayCache` instance.

For more information about Doctrine Cache visit [https://github.com/doctrine/cache](https://github.com/doctrine/cache)

## Usage

```
<?php

require '../vendor/autoload.php';

$cache = new \Doctrine\Common\Cache\FilesystemCache('path/to/temp');
$client = new Adrenth\Tvrage\Client($cache);

// Search TV-serie Top Gear
$response = $client->search('top gear'); // ShowsResponse

// Perform a full search on Ray Donovan
$response = $client->fullSearch('ray donovan');  // ShowsResponse

// Get (full) show info by passing the tvrageid (Buffy the Vampire Slayer)
$response = $client->showInfo(2930); // ShowResponse
$response = $client->fullShowInfo(2930); // ShowResponse

// Get Episode list of Buffy the Vampire Slayer
$response = $client->episodeList(2930); // SeasonsResponse

// Get Episode infor of Buffy the Vampire Slayer (season 2, episode 4)
$response = $client->episodeInfo(2930, 2, 4); // EpisodeResponse

```

* `SeasonsResponse`; contains 0 or more `Season` instances (episodeList)
* `EpisodeResponse`; contains 0 or 1 `Episode` instance (episodeInfo)
* `ShowResponse`; contains 0 or 1 `Show` instance (showInfo)
* `ShowsResponse`; contains 0 or more `Show` instances (search, fullSearch)

## Contributing

Please contribute to make this package even better.

