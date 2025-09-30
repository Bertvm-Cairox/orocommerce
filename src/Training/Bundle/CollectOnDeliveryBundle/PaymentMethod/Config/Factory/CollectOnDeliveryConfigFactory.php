<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Factory;

use Doctrine\Common\Collections\Collection;
use Oro\Bundle\IntegrationBundle\Generator\IntegrationIdentifierGeneratorInterface;
use Oro\Bundle\LocaleBundle\Helper\LocalizationHelper;
use Training\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfig;

class CollectOnDeliveryConfigFactory implements CollectOnDeliveryConfigFactoryInterface
{
    private LocalizationHelper $localizationHelper;
    private IntegrationIdentifierGeneratorInterface $identifierGenerator;

    public function __construct(
        LocalizationHelper $localizationHelper,
        IntegrationIdentifierGeneratorInterface $identifierGenerator
    ) {
        $this->localizationHelper = $localizationHelper;
        $this->identifierGenerator = $identifierGenerator;
    }

    public function create(CollectOnDeliverySettings $settings): CollectOnDeliveryConfig
    {
        $params = [];
        $channel = $settings->getChannel();

        $params[CollectOnDeliveryConfig::FIELD_LABEL] = $this->getLocalizedValue($settings->getLabels());
        $params[CollectOnDeliveryConfig::FIELD_SHORT_LABEL] = $this->getLocalizedValue($settings->getShortLabels());
        $params[CollectOnDeliveryConfig::FIELD_ADMIN_LABEL] = $channel->getName();
        $params[CollectOnDeliveryConfig::FIELD_PAYMENT_METHOD_IDENTIFIER] =
            $this->identifierGenerator->generateIdentifier($channel);

        return new CollectOnDeliveryConfig($params);
    }

    private function getLocalizedValue(Collection $values): string
    {
        return (string)$this->localizationHelper->getLocalizedValue($values);
    }
}