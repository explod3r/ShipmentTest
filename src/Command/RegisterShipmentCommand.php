<?php


namespace App\Command;


use App\Entity\Order as OrderEntity;
use App\Enum\Providers;
use App\Service\Order;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class RegisterShipmentCommand extends Command
{
    protected static $defaultName = 'app:register:shipment';
    private $order;
    private $orderEntity;

    public function __construct(Order $order)
    {
        $this->order = $order;
        parent::__construct(self::$defaultName);

        $entityData = json_decode(file_get_contents(__DIR__ . '/../../tests/Fixtures/Order.json'), true);
        $this->orderEntity = new OrderEntity();
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers);

        $serializer->denormalize($entityData,
            get_class($this->orderEntity),
            null,
            [AbstractNormalizer::OBJECT_TO_POPULATE => $this->orderEntity]);
    }

    protected function configure(): void
    {
        $this->setDescription('Register shipment for shipping provider.');
        $this->addArgument('provider', InputArgument::OPTIONAL, 'UPS, OMNIVA or DHL.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $providerKey = strtolower((string)$input->getArgument('provider'));

        switch ($providerKey) {
            case Providers::UPS()->getValue():
            case Providers::DHL()->getValue():
            case Providers::OMNIVA()->getValue():
                $this->orderEntity->setShippingProviderKey($providerKey);
                $this->order->registerShipping($this->orderEntity);
                break;
            default:
                $output->writeln('Wrong input argument.');
                return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}