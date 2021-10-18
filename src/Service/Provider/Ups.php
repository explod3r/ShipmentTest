<?php


namespace App\Service\Provider;


use App\Entity\Order;

class Ups extends AbstractProvider
{
    protected function buildQuery(Order $order): array
    {
        return [
            'order_id' => $order->getId(),
            'country' => $order->getCountry(),
            'street' => $order->getStreet(),
            'city' => $order->getCity(),
            'post_code' => $order->getPostCode()
        ];
    }
}