<?php


namespace App\Client;


use Psr\Http\Message\ResponseInterface;

class Client implements ClientInterface
{
    private $client;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function send(string $url, array $query): ResponseInterface
    {
        return $this->client->request('GET', $url, [
            'query' => $query
        ]);
    }
}