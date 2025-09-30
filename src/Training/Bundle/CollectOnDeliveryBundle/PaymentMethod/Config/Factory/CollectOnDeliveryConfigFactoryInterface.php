<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Factory;

use Training\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;

interface CollectOnDeliveryConfigFactoryInterface
{
    public function create(CollectOnDeliverySettings $settings);
}