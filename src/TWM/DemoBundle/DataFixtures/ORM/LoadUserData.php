<?php

namespace TWM\DemoBundle\DataFixtures\ORM;

use TWM\DemoBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    private $manager;
    private $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->loadUser('admin', 'admin', 'admin@twm.com');
        $this->loadUser('superadmin', 'superadmin', 'sa@twm.com');
        $this->loadUser('antoine', 'antoine', 'antoine@twm.com');
        $this->loadUser('inactive', 'inactive', 'inactive@twm.com', false);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * @param ContainerInterface $container A ContainerInterface instance
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function loadUser($username, $password, $email, $isActive = true)
    {
        $user = new User();
        $user->setUsername($username);
        $user->setSalt(md5(uniqid()));

        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user)
        ;

        $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
        $user->setEmail($email);
        $user->setIsActive($isActive);

        $this->manager->persist($user);
        $this->manager->flush();

        $this->addReference($username . '-user', $user);
    }

}
