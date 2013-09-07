<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\DemoBundle\DataFixtures\ORM;

use TWM\DemoBundle\Entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Load Roles
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
class LoadRoleData extends AbstractFixture implements OrderedFixtureInterface
{

    private $manager;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->loadRole('superadmin', 'ROLE_SUPER_ADMIN');
        $this->loadRole('admin', 'ROLE_ADMIN');
        $this->loadRole('user', 'ROLE_USER');
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }

    private function loadRole($name, $role)
    {
        $role = new Role($name, $role);

        $this->manager->persist($role);
        $this->manager->flush();

        $this->addReference($name . '-role', $role);
    }

}
