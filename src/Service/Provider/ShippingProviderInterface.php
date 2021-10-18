<?php


namespace App\Service\Provider;


use App\Entity\Order;

interface ShippingProviderInterface
{
    public function register(Order $order): void;
}