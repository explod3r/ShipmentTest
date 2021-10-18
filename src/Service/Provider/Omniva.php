<?php


namespace App\Service\Provider;


use App\Entity\Order;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class Omniva extends AbstractProvider
{
    protected function buildQuery(Order $order): array
    {
        return [
            'order_id' => $order->getId(),
            'pickup_point_id' => $this->findPickupPoint($order)
        ];
    }

    protected function findPickupPoint(Order $order): string
    {
        $query = [
            'country' => $order->getCountry(),
            'post_code' => $order->getPostCode()
        ];

        $response = $this->client->send($this->findUrl, $query);
        $status = $response->getStatusCode();
        if (200 != $status) {
            throw new BadRequestException('Request failed. Status code: ' . $status);
        }

        return $response->getBody()->getContents();
    }
}