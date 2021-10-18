<?php


namespace App\Service\Provider;


use App\Client\ClientInterface;
use App\Entity\Order;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

abstract class AbstractProvider implements ShippingProviderInterface
{
    protected $client;
    protected $registerUrl;
    protected $findUrl;

    public function __construct(ClientInterface $client, string $registerUrl, string $findUrl = '')
    {
        $this->client = $client;
        $this->registerUrl = $registerUrl;
        $this->findUrl = $findUrl;
    }

    public function register(Order $order): void
    {
        $query = $this->buildQuery($order);
        $response = $this->client->send($this->registerUrl, $query);

        $status = $response->getStatusCode();
        if (200 != $status) {
            throw new BadRequestException('Request failed. Status code: ' . $status);
        }
    }
}