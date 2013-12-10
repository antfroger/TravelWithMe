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

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Nelmio\Alice\Fixtures;

/**
 * Load fake User entities to fill the database
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
class LoadUserData implements FixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $om)
    {
        Fixtures::load(
            array(__DIR__ . '/../Fixtures/User.yml'),
            $om
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
