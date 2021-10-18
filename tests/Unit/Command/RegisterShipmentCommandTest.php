<?php

namespace App\Tests\Unit\Command;

use App\Command\RegisterShipmentCommand;
use App\Service\Order;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class RegisterShipmentCommandTest extends KernelTestCase
{
    private $orderMock;
    private $commandTester;


    protected function setUp(): void
    {
        $this->orderMock = $this->getMockBuilder(Order::class)
            ->disableOriginalConstructor()
            ->getMock();

        $kernel = static::createKernel();
        $application = new Application($kernel);
        $application->add(new RegisterShipmentCommand($this->orderMock));
        $command = $application->find('app:register:shipment');
        $this->commandTester = new CommandTester($command);
    }

    protected function tearDown(): void
    {
        $this->orderMock = null;
        $this->commandTester = null;
    }

    public function testExecute(): void
    {
        $this->commandTester->execute([
            'provider' => 'ups',
        ]);

        $this->assertEquals(0, $this->commandTester->getStatusCode());
    }
}