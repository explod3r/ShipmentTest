<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Order as OrderEntity;
use App\Service\Provider\ShippingProviderInterface;
use Psr\Container\ContainerInterface;

class Order
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function registerShipping(OrderEntity $order): void
    {
        $providerKey = $order->getShippingProviderKey();
        $provider = $this->container->get($providerKey . '.provider');

        if (!$provider instanceof ShippingProviderInterface) {
            throw new \InvalidArgumentException(
                'Wrong Object Type Returned: ' . get_class($provider)
                . ', ' . ShippingProviderInterface::class . ' expected.'
            );
        }

        $provider->register($order);
    }
}
