<?php

namespace Training\Bundle\DemoBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\UserBundle\Entity\Role;
use Oro\Bundle\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserRoles extends AbstractFixture implements ContainerAwareInterface
{
    private ?ContainerInterface $container;

    public function setContainer(?ContainerInterface $container = null): void
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager): void
    {
        $rolesData = [ // see CAI-150
            'ROLE_ADMIN' => ['label' => 'Admin'],
            'ROLE_CAIROX_DEFAULT' => ['label' => 'Cairox Default'],
            'ROLE_CAIROX_LOOK' => ['label' => 'Cairox Look'],
        ];

        foreach ($rolesData as $roleName => $data) {
            $role = $manager->getRepository(Role::class)->findOneBy(['role' => $roleName]);

            // create Role if it doesn't exist
            if (!$role instanceof Role) {
                $role = new Role($roleName);
                $role->setLabel($data['label']);
                $manager->persist($role);
            }

            // flush to ensure the Role has an id
            $manager->flush();

            switch ($roleName) {
                case 'ROLE_ADMIN':
                    $this->configureAdminPermissions($role);
                    break;
                case 'ROLE_CAIROX_DEFAULT':
                    $this->configureDefaultPermissions($role);
                    break;
                case 'ROLE_CAIROX_LOOK':
                    $this->configureLookPermissions($role);
                    break;
            }
        }

        $manager->flush();
    }

    private function configureAdminPermissions(Role $role): void
    {
        $aclManager = $this->container->get('oro_security.acl.manager');

        $entities = [
            User::class
            // TODO what entities to add?
        ];

        foreach ($entities as $entityClass) {
            // https://doc.oroinc.com/backend/security/acl-manager/#backend-security-bundle-acl-manager
            if ($aclManager->isAclEnabled()) {
                $oid = $aclManager->getOid('entity:' . $entityClass);
                $sid = $aclManager->getSid($role);
                $builder = $aclManager->getMaskBuilder($oid);

                $mask = $builder->add('VIEW')->add('CREATE')->add('EDIT')->add('DELETE')->add('ASSIGN')->add('SHARE');

                $aclManager->setPermission($sid, $oid, $mask);
            }
        }
    }

    private function configureDefaultPermissions(Role $role): void
    {
        $aclManager = $this->container->get('oro_security.acl.manager');

        $entities = [
            User::class
            // TODO what entities to add?
        ];

        foreach ($entities as $entityClass) {
            if ($aclManager->isAclEnabled()) {
                $oid = $aclManager->getOid('entity:' . $entityClass);
                $sid = $aclManager->getSid($role);
                $builder = $aclManager->getMaskBuilder($oid);

                $mask = $builder->add('VIEW')->get();

                $aclManager->setPermission($sid, $oid, $mask);
            }
        }
    }

    private function configureLookPermissions(Role $role): void
    {
        $aclManager = $this->container->get('oro_security.acl.manager');

        $entities = [
            User::class
            // TODO what entities to add?
        ];

        foreach ($entities as $entityClass) {
            if ($aclManager->isAclEnabled()) {
                $oid = $aclManager->getOid('entity:' . $entityClass);
                $sid = $aclManager->getSid($role);
                $builder = $aclManager->getMaskBuilder($oid);

                $mask = $builder->add('VIEW')->get();

                $aclManager->setPermission($sid, $oid, $mask);
            }
        }
    }

}