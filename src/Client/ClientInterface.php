<?php


namespace App\Client;


use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    public function send(string $url, array $query): ResponseInterface;
}