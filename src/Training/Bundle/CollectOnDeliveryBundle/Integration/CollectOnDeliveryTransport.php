<?php

namespace Training\Bundle\CollectOnDeliveryBundle\Integration;

use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;
use Training\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
use Training\Bundle\CollectOnDeliveryBundle\Form\Type\CollectOnDeliverySettingsType;

class CollectOnDeliveryTransport implements TransportInterface
{
    public function init(Transport $transportEntity)
    {

    }

    public function getLabel(): string
    {
        return 'collect_on_delivery.settings.transport.label';
    }

    public function getSettingsFormType(): string
    {
        return CollectOnDeliverySettingsType::class;
    }
    public function getSettingsEntityFQCN(): string
    {
        return CollectOnDeliverySettings::class;
    }
}