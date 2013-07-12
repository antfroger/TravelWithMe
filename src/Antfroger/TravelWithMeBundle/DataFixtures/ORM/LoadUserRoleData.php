<?php

namespace Antfroger\TravelWithMeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserRoleData extends AbstractFixture implements OrderedFixtureInterface
{

    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->loadUserRole('admin', 'admin');
        $this->loadUserRole('antoine', 'superadmin');
        $this->loadUserRole('carole', 'user');
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }

    private function loadUserRole($userRef, $roleRef)
    {
        $user = $this->getReference($userRef . '-user');
        $user->addRole($this->getReference($roleRef . '-role'));

        $this->manager->flush();
    }

}