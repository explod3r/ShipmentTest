<?php


namespace App\Tests\Unit\Service\Provider;


use App\Entity\Order as OrderEntity;
use App\Service\Provider\Omniva;
use App\Tests\Mock\Client\ClientMock;
use PHPUnit\Framework\TestCase;

class OmnivaTest extends TestCase
{
    private $client;
    private $orderEntity;

    protected function setUp():void
    {
        $this->client = new ClientMock();

        $this->orderEntity = new OrderEntity();
        $this->orderEntity->setId('1');
        $this->orderEntity->setStreet('Street');
        $this->orderEntity->setPostCode('1234');
        $this->orderEntity->setCity('City');
        $this->orderEntity->setCountry('Country');
    }

    protected static function getMethod($name): \ReflectionMethod
    {
        $class = new \ReflectionClass('App\Service\Provider\Omniva');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * @test
     */
    public function shouldFindPickupPoint(): void
    {
        $method = self::getMethod('findPickupPoint');
        $provider = new Omniva($this->client, '');
        $this->assertEquals('', $method->invokeArgs($provider, [$this->orderEntity]));
    }
}