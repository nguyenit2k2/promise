<?php

require_once(__DIR__ . '/vendor/autoload.php');
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

$client = new Client;

$urls = [
    'http://localhost/promise/server.php?idx=0',
    'http://localhost/promise/server.php?idx=1',
    'http://localhost/promise/server.php?idx=2',
    'http://localhost/promise/server.php?idx=3',
    'http://localhost/promise/server.php?idx=4',
];

$promises = [];
echo "Promise without wait <br>";
foreach ($urls as $idx => $url) {
    
    $promises[] = $client->getAsync($url)
        ->then(
            function (ResponseInterface $response) {
                echo $response->getBody();
                return $response;
            },
            function (RequestException $e) {
                echo $e->getMessage();
            }
        );
}

$results = Utils::settle($promises)->wait();

echo "Promise with Wait<br>";
foreach ($promises as $promise) {
    $response = $promise->wait();
    echo $response->getBody();
}