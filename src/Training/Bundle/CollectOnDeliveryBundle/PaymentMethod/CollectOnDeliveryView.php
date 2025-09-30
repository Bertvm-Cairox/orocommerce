<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod;

use Oro\Bundle\PaymentBundle\Context\PaymentContextInterface;
use Oro\Bundle\PaymentBundle\Method\View\PaymentMethodViewInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

class CollectOnDeliveryView implements PaymentMethodViewInterface
{
    public function __construct(protected CollectOnDeliveryConfigInterface $config)
    {}

    public function getOptions(PaymentContextInterface $context): array
    {
        return [];
    }

    public function getBlock(): string
    {
        return '_payment_methods_collect_on_delivery_widget';
    }

    public function getLabel(): string
    {
        return $this->config->getLabel();
    }

    public function getShortLabel(): string
    {
        return $this->config->getShortLabel();
    }

    public function getAdminLabel(): string
    {
        return $this->config->getAdminLabel();
    }

    public function getPaymentMethodIdentifier(): string
    {
        return $this->config->getPaymentMethodIdentifier();
    }
}