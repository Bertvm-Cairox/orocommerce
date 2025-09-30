<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\View\Factory;

use Oro\Bundle\PaymentBundle\Method\View\PaymentMethodViewInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\CollectOnDeliveryView;

class CollectOnDeliveryViewFactory implements CollectOnDeliveryViewFactoryInterface
{
    public function create(CollectOnDeliveryConfigInterface $config): PaymentMethodViewInterface
    {
        return new CollectOnDeliveryView($config);
    }
}