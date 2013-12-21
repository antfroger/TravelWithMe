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
//use Faker\Factory;
//use Nelmio\Alice\Fixtures;
//use TWM\CommonBundle\Provider\DateTime;
//
///**
// * Load fake Travel entities (and its dependencies) to fill the database
// *
// * @author Antoine Froger <antfroger@gmail.com>
// */
//class LoadTravelData extends AbstractDataFixtureLoader
//{
//
//    /**
//     * {@inheritDoc}
//     */
//    public function load(ObjectManager $om)
//    {
//        parent::load($om);
//
//        $faker = Factory::create($this->locale);
//        $faker->addProvider(new DateTime($faker));
//
//        Fixtures::load(
//            array(
//                __DIR__ . '/../Fixtures/Travel.yml'
//            ),
//            $om,
//            array(
//                'locale'    => $this->locale,
//                'providers' => array(
//                    new \TWM\SiteBundle\DataFixtures\Provider\Travel\Step($faker)
//                )
//            )
//        );
//    }
//
//    /**
//     * {@inheritDoc}
//     */
//    public function getOrder()
//    {
//        return 2;
//    }
//}
