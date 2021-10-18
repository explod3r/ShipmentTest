<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    private $order;

    protected function setUp(): void
    {
        $this->order = new Order();
    }
    /**
     * @test
     */
    public function shouldHaveUpsAsDefaultShipping(): void
    {
        $this->assertEquals('ups', $this->order->getShippingProviderKey());
    }

    public function testOrderCreate(): void
    {
        $this->order->setShippingProviderKey('dhl');
        $this->order->setId('1');
        $this->order->setStreet('Street');
        $this->order->setPostCode('1234');
        $this->order->setCity('City');
        $this->order->setCountry('Country');


        $this->assertEquals('1', $this->order->getId());
        $this->assertEquals('Street', $this->order->getStreet());
        $this->assertEquals('1234', $this->order->getPostCode());
        $this->assertEquals('City', $this->order->getCity());
        $this->assertEquals('Country', $this->order->getCountry());
        $this->assertEquals('dhl', $this->order->getShippingProviderKey());
    }
}
