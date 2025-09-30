<?php

namespace Training\Bundle\CollectOnDeliveryBundle\Integration;

use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;

class CollectOnDeliveryChannelType implements ChannelInterface
{
    const TYPE  = 'collect_on_delivery';

    public function getLabel(): string
    {
        return 'collect_on_delivery.channel_type.label';
    }
}