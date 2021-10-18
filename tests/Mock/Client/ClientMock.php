<?php


namespace App\Tests\Mock\Client;


use App\Client\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class ClientMock implements ClientInterface
{
    public function send(string $url, array $query): ResponseInterface
    {
        return new Response();
    }
}