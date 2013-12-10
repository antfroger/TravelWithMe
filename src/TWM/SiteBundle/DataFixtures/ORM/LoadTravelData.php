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
 * Load fake Travel entities (and its dependencies) to fill the database
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
class LoadTravelData implements FixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $om)
    {
        Fixtures::load(
            array(__DIR__ . '/../Fixtures/Travel.yml'),
            $om,
            array('providers' => array('\TWM\CommonBundle\Provider\DateTime'))
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
