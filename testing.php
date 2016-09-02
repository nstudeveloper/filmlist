<?php

require __DIR__ . '/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_url' => 'http://site.com',
    'defaults' => [
        'exceptions' => false
    ]
]);

$data = [
    'firstName' => 'FirstName',
    'lastName' => 'LastName'
];

$response = $client->post('/api/actor', [
    'body' => json_encode($data)
]);
echo $response;
echo "\n\n";