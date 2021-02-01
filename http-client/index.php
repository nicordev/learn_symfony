<?php

if (!is_dir(__DIR__.'/vendor')) {
    echo "No vendor directory, running \033[33mcomposer install...\033[0m\n";
    shell_exec('composer install');
}

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpClient\HttpClient;


$client = HttpClient::create();

echo "\033[1mTry Symfony HTTP client\033[0m\n";

// Asynchronous call
$response = $client->request('GET', 'https://api.github.com/repos/symfony/symfony-docs');

echo "1. The request has been sent asynchronously, now the rest of the code can be executed normally.\n";

// Blocking code
$statusCode = $response->getStatusCode();

echo "2. This statement is reach only after receiving the response. Every call to the response getters are synchronous.\n";

// $statusCode = 200
$contentType = $response->getHeaders()['content-type'][0];
// $contentType = 'application/json'
$content = $response->getContent();
// $content = '{"id":521583, "name":"symfony-docs", ...}'
$content = $response->toArray();
// $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

echo "3. At last, here is a part of the response content: \033[32;1m{$content['name']}\033[0m\n";