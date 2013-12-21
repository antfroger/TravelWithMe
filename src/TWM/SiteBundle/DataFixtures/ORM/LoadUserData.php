<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @unused
 * While Alice does not allow managing references between fixtures files
 * this file is not used
 */

//namespace TWM\SiteBundle\DataFixtures\ORM;
//
//use Doctrine\Common\Persistence\ObjectManager;
//use Nelmio\Alice\Fixtures;
//
///**
// * Load fake User entities to fill the database
// *
// * @author Antoine Froger <antfroger@gmail.com>
// */
//class LoadUserData extends AbstractDataFixtureLoader
//{
//
//    /**
//     * {@inheritDoc}
//     */
//    public function load(ObjectManager $om)
//    {
//        parent::load($om);
//
//        Fixtures::load(
//            array(__DIR__ . '/../Fixtures/User.yml'),
//            $om,
//            array(
//                'locale' => $this->locale,
//            )
//        );
//    }
//
//    /**
//     * {@inheritDoc}
//     */
//    public function getOrder()
//    {
//        return 1;
//    }
//}
