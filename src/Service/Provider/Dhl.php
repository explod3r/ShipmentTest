<?php


namespace App\Service\Provider;


use App\Entity\Order;

class Dhl extends AbstractProvider
{
    protected function buildQuery(Order $order): array
    {
        return [
            'order_id' => $order->getId(),
            'country' => $order->getCountry(),
            'address' => $order->getStreet(),
            'town' => $order->getCity(),
            'zip_code' => $order->getPostCode()
        ];
    }
}