<?php

/**
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractDataFixtureLoader implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var string
     */
    protected $locale;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $om)
    {
        $locale = $this->container->getParameter('locale');

        $this->locale = (2 === strlen($locale))
            ? $locale . '_' . strtoupper($locale)
            : $locale;
    }
}
