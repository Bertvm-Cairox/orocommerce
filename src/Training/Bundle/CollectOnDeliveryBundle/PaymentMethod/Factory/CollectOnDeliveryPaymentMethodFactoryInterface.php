<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Factory;

use Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

interface CollectOnDeliveryPaymentMethodFactoryInterface
{
    public function create(CollectOnDeliveryConfigInterface $config): PaymentMethodInterface;
}