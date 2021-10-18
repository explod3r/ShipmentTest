<?php


namespace App\Tests\Unit\Service\Provider;


use App\Entity\Order as OrderEntity;
use App\Service\Provider\Ups;
use App\Tests\Mock\Client\ClientMock;
use PHPUnit\Framework\TestCase;

class UpsTest extends TestCase
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
        $class = new \ReflectionClass('App\Service\Provider\Ups');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * @test
     */
    public function shouldBuildQuery(): void
    {
        $result = [
            'order_id' => '1',
            'country' => 'Country',
            'street' => 'Street',
            'city' => 'City',
            'post_code' => '1234'
        ];

        $method = self::getMethod('buildQuery');
        $provider = new Ups($this->client, '');
        $this->assertEquals($result, $method->invokeArgs($provider, [$this->orderEntity]));
    }
}