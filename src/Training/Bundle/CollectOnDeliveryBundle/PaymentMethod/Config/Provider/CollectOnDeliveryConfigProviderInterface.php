<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider;

use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

interface CollectOnDeliveryConfigProviderInterface
{
    public function getPaymentConfigs(): array;
    public function getPaymentConfig(string $identifier): ?CollectOnDeliveryConfigInterface;
    public function hasPaymentConfig(string $identifier): bool;
}