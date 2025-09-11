<?php

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;
use Oro\Bundle\UserBundle\Entity\User;

readonly class EntityNameProviderDecorator implements EntityNameProviderInterface
{
    public function __construct(private EntityNameProviderInterface $originalProvider) {}

    public function getName($format, $locale, $entity): string
    {
        if ($entity instanceof User) {
            return sprintf('%s %s %s', $entity->getLastName(), $entity->getFirstName(), $entity->getMiddleName());
        }
        return $this->originalProvider->getName($format, $locale, $entity);
    }

    public function getNameDQL($format, $locale, $className, $alias): string
    {
        return $this->getNameDQL($format, $locale, $className, $alias);
    }
}