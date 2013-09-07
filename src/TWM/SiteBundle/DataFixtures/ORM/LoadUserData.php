<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Load Users
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
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

        shell_exec(<<<COMMAND
            php app/console fos:user:create antoine antoine@travelwithme.eu antoine --super-admin;
            php app/console fos:user:create inactive inactive@travelwithme.eu inactive --inactive;
            php app/console fos:user:create admin admin@travelwithme.eu admin;
            php app/console fos:user:promote admin ROLE_ADMIN;
COMMAND
        );
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

}
