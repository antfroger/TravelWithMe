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
use Faker\Factory;
use Nelmio\Alice\Fixtures;
use TWM\CommonBundle\Entity\File\File;
use TWM\CommonBundle\Helper\File as FileHelper;
use TWM\CommonBundle\Provider\DateTime;
use TWM\SiteBundle\DataFixtures\Provider\Travel\Step;

/**
 * Load fake entities to fill the database
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
class LoadData extends AbstractDataFixtureLoader
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $om)
    {
        $this->prepare();

        parent::load($om);

        $faker = Factory::create($this->locale);
        $faker->addProvider(new DateTime($faker));

        Fixtures::load(
            array(
                __DIR__ . '/../Fixtures/User.yml',
                __DIR__ . '/../Fixtures/Travel.yml'
            ),
            $om,
            array(
                'locale'    => $this->locale,
                'providers' => array(
                    new Step($faker)
                )
            )
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
     * Prepare the directories structure before loading fixtures
     */
    private function prepare()
    {
        $this->prepareFileDirectory();
    }

    /**
     * Create or empty the directory containing files
     */
    private function prepareFileDirectory()
    {
        $dir = File::getUploadRootDir();

        if (!is_dir($dir)) {
            mkdir($dir);
        } else {
            FileHelper::emptyDir($dir);
        }
    }
}
