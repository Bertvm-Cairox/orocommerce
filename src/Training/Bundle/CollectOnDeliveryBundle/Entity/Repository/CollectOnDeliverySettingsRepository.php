<?php

namespace Training\Bundle\CollectOnDeliveryBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Training\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;

class CollectOnDeliverySettingsRepository extends EntityRepository
{
    /**
     * @return CollectOnDeliverySettings[]
     */
    public function getEnabledSettings(): array
    {
        return $this->createQueryBuilder('settings')
            ->innerJoin('settings.channel', 'channel')
            ->andWhere('channel.enabled = true')
            ->getQuery()
            ->getResult();
    }
}