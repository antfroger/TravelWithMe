<?php

namespace Antfroger\TravelWithMeBundle\DataFixtures\ORM;

use Antfroger\TravelWithMeBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAware;

class LoadUserData extends ContainerAware implements FixtureInterface
{

    private $manager;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->loadUser('admin', 'admin', 'admin@twm.com');
        $this->loadUser('antoine', 'antoine', 'antoine@twm.com');
        $this->loadUser('carole', 'carole', 'carole@twm.com');
    }

    private function loadUser($username, $password, $email)
    {
        $user = new User();
        $user->setUsername($username);
        $user->setSalt(md5(uniqid()));

//        $encoder = $this->container
//            ->get('security.encoder_factory')
//            ->getEncoder($user)
//        ;

//        $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
        $user->setPassword($password);
        $user->setEmail($email);

        $this->manager->persist($user);
        $this->manager->flush();
    }

}
