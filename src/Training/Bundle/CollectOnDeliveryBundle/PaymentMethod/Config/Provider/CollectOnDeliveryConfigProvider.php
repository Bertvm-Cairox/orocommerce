<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider;

use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Training\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
use Training\Bundle\CollectOnDeliveryBundle\Entity\Repository\CollectOnDeliverySettingsRepository;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Factory\CollectOnDeliveryConfigFactoryInterface;

class CollectOnDeliveryConfigProvider implements CollectOnDeliveryConfigProviderInterface
{
    protected array $configs;

    public function __construct(
        protected ManagerRegistry $doctrine,
        protected CollectOnDeliveryConfigFactoryInterface $configFactory,
        protected LoggerInterface $logger
    ) {}

    public function getPaymentConfigs(): array
    {
        $configs = [];

        $settings = $this->getEnabledIntegrationSettings();

        foreach ($settings as $setting) {
            $config = $this->configFactory->create($setting);

            $configs[$config->getPaymentMethodIdentifier()] = $config;
        }

        return $configs;
    }

    public function getPaymentConfig($identifier): ?CollectOnDeliveryConfigInterface
    {
        $paymentConfigs = $this->getPaymentConfigs();

        if ([] === $paymentConfigs || false === array_key_exists($identifier, $paymentConfigs)) {
            return null;
        }

        return $paymentConfigs[$identifier];
    }

    public function hasPaymentConfig($identifier): bool
    {
        return null !== $this->getPaymentConfig($identifier);
    }

    /**
     * @return CollectOnDeliverySettings[]
     */
    protected function getEnabledIntegrationSettings(): array
    {
        try {
            /** @var CollectOnDeliverySettingsRepository $repository */
            $repository = $this->doctrine
                ->getManagerForClass(CollectOnDeliverySettings::class)
                ->getRepository(CollectOnDeliverySettings::class);

            return $repository->getEnabledSettings();
        } catch (\UnexpectedValueException $e) {
            $this->logger->critical($e->getMessage());

            return [];
        }
    }
}