<?php


namespace App\Tests\Unit\Service;


use App\Entity\Order as OrderEntity;
use App\Service\Order;
use App\Service\Provider\Ups;
use App\Tests\Mock\Client\ClientMock;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

class OrderTest extends TestCase
{
    private $containerMock;
    private $orderEntityMock;
    private $order;
    private $provider;

    protected function setUp(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderEntityMock = $this->getMockBuilder(OrderEntity::class)
            ->getMock();

        $this->provider = new Ups(new ClientMock(), '');
        $this->order = new Order($this->containerMock);
    }

    /**
     * @test
     */
    public function shouldRegisterShipment(): void
    {
        $this->expectNotToPerformAssertions();

        $this->containerMock->method("get")->willReturn($this->provider);

        $this->order->registerShipping($this->orderEntityMock);
    }
}