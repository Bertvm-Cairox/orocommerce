<?php

namespace Training\Bundle\CollectOnDeliveryBundle\PaymentMethod;

use Oro\Bundle\PaymentBundle\Context\PaymentContextInterface;
use Oro\Bundle\PaymentBundle\Entity\PaymentTransaction;
use Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface;
use Training\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

class CollectOnDelivery implements PaymentMethodInterface
{
    public function __construct(private readonly CollectOnDeliveryConfigInterface $config)
    {
    }

    public function execute($action, PaymentTransaction $paymentTransaction): array
    {
        $paymentTransaction->setAction(PaymentMethodInterface::INVOICE);
        $paymentTransaction->setActive(true);
        $paymentTransaction->setSuccessful(true);

        return [];
    }

    public function getIdentifier(): string
    {
        return $this->config->getPaymentMethodIdentifier();
    }

    public function isApplicable(PaymentContextInterface $context): true
    {
        return true;
    }

    public function supports($actionName): bool
    {
        return $actionName === self::PURCHASE;
    }
}