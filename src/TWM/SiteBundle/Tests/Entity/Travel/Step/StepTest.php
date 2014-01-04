<?php

/**
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Tests\Entity\Travel\Step;

use TWM\SiteBundle\Entity\Travel\Step\Step;

/**
 * Tests Step class
 */
class StepTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Step
     */
    protected $object;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->object = new Step();
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Step\Step::getDuration
     * @covers TWM\SiteBundle\Entity\Travel\Step\Step::guessDuration
     */
    public function testGetDuration()
    {
        $this->object
            ->setStartedAt(null)
            ->setFinishedAt(new \DateTime('+2 days'));
        $this->assertEquals(0, $this->object->getDuration());

        $this->object
            ->setStartedAt(new \DateTime('now'))
            ->setFinishedAt(null);
        $this->assertEquals(0, $this->object->getDuration());

        $this->object
            ->setStartedAt(new \DateTime('-3 days'))
            ->setFinishedAt(new \DateTime('+2 days'));
        $this->assertEquals(5, $this->object->getDuration());

        $this->object
            ->setStartedAt(new \DateTime('now'))
            ->setFinishedAt(new \DateTime('now'));
        $this->assertEquals(0, $this->object->getDuration());

        $this->object
            ->setStartedAt(new \DateTime('yesterday'))
            ->setFinishedAt(new \DateTime('tomorrow'));
        $this->assertEquals(2, $this->object->getDuration());
    }
}
