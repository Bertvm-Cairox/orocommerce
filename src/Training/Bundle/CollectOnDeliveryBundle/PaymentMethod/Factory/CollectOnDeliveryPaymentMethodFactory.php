<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Factory;

use Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\CollectOnDelivery;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

class CollectOnDeliveryPaymentMethodFactory implements CollectOnDeliveryPaymentMethodFactoryInterface
{
    public function create(CollectOnDeliveryConfigInterface $config): PaymentMethodInterface
    {
        return new CollectOnDelivery($config);
    }
}