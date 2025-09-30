<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\Provider;

use Oro\Bundle\PaymentBundle\Method\View\AbstractPaymentMethodViewProvider;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider\CollectOnDeliveryConfigProviderInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\Factory\CollectOnDeliveryViewFactoryInterface;

class CollectOnDeliveryViewProvider extends AbstractPaymentMethodViewProvider
{
    public function __construct(
        private readonly CollectOnDeliveryConfigProviderInterface $configProvider,
        private readonly CollectOnDeliveryViewFactoryInterface $factory
    ) {
        parent::__construct();
    }

    protected function buildViews(): void
    {
        $configs = $this->configProvider->getPaymentConfigs();
        foreach ($configs as $config) {
            $this->addCollectOnDeliveryView($config);
        }
    }

    protected function addCollectOnDeliveryView(CollectOnDeliveryConfigInterface $config): void
    {
        $this->addView(
            $config->getPaymentMethodIdentifier(),
            $this->factory->create($config)
        );
    }
}