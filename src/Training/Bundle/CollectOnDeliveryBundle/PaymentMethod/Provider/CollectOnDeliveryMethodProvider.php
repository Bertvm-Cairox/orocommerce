<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Provider;

use Oro\Bundle\PaymentBundle\Method\Provider\AbstractPaymentMethodProvider;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider\CollectOnDeliveryConfigProviderInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Factory\CollectOnDeliveryPaymentMethodFactoryInterface;

class CollectOnDeliveryMethodProvider extends AbstractPaymentMethodProvider
{
    public function __construct(
        protected CollectOnDeliveryConfigProviderInterface $configProvider,
        private readonly CollectOnDeliveryPaymentMethodFactoryInterface $factory
    ) {
        parent::__construct();
    }

    protected function collectMethods(): void
    {
        $configs = $this->configProvider->getPaymentConfigs();
        foreach ($configs as $config) {
            $this->addCollectOnDeliveryMethod($config);
        }
    }

    protected function addCollectOnDeliveryMethod(CollectOnDeliveryConfigInterface $config): void
    {
        $this->addMethod(
            $config->getPaymentMethodIdentifier(),
            $this->factory->create($config)
        );
    }
}