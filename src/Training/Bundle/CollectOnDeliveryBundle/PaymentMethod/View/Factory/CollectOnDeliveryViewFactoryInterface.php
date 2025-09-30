<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\Factory;

use Oro\Bundle\PaymentBundle\Method\View\PaymentMethodViewInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

interface CollectOnDeliveryViewFactoryInterface
{
    public function create(CollectOnDeliveryConfigInterface $config): PaymentMethodViewInterface;
}