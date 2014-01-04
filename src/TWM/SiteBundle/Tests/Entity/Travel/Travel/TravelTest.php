<?php

/**
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Tests\Entity\Travel\Travel;

use Doctrine\Common\Collections\ArrayCollection;
use TWM\SiteBundle\Entity\Travel\Step\Step;
use TWM\SiteBundle\Entity\Travel\Travel\Travel;

/**
 *
 */
class TravelTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Travel
     */
    protected $object;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->object = new Travel();
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getStartedAt
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessStartedAt
     */
    public function testStartedAtIsFilled()
    {
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('+3 days'),
                new \DateTime('+5 days')
            ),
            $this->getMockedStep(
                new \DateTime('yesterday'),
                new \DateTime('+3 days')
            ),
            $this->getMockedStep(
                new \DateTime('+5 days'),
                new \DateTime('+9 days')
            ),
        )));

        $this->assertEquals(
            new \DateTime('yesterday'),
            $this->object->getStartedAt()
        );
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getStartedAt
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessStartedAt
     */
    public function testStartedAtIsNull()
    {
        // One step with a finish date set to null
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                null,
                new \DateTime('+5 days')
            ),
        )));

        $this->assertNull(
            $this->object->getStartedAt()
        );

        // One step without start date
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(),
        )));

        $this->assertNull(
            $this->object->getStartedAt()
        );

        // No step
        $this->object->clearSteps();

        $this->assertNull(
            $this->object->getStartedAt()
        );
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getFinishedAt
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessFinishedAt
     */
    public function testFinishedAtIsFilled()
    {
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('yesterday'),
                new \DateTime('+3 days')
            ),
            $this->getMockedStep(
                new \DateTime('+5 days'),
                new \DateTime('+9 days')
            ),
            $this->getMockedStep(
                new \DateTime('+3 days'),
                new \DateTime('+5 days')
            ),
        )));

        $this->assertEquals(
            new \DateTime('+9 days'),
            $this->object->getFinishedAt()
        );
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getFinishedAt
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessFinishedAt
     */
    public function testFinishedAtIsNull()
    {
        // One step with a finish date set to null
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('+5 days'),
                null
            ),
        )));

        $this->assertNull(
            $this->object->getFinishedAt()
        );

        // One step without finish date
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(),
        )));

        $this->assertNull(
            $this->object->getFinishedAt()
        );

        // No step
        $this->object->clearSteps();

        $this->assertNull(
            $this->object->getFinishedAt()
        );
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getDuration
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessDuration
     */
    public function testDuration()
    {
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('yesterday'),
                new \DateTime('+3 days')
            ),
            $this->getMockedStep(
                new \DateTime('+3 days'),
                new \DateTime('+5 days')
            ),
            $this->getMockedStep(
                new \DateTime('+5 days'),
                new \DateTime('+9 days')
            ),
        )));

        $this->assertEquals(
            10,
            $this->object->getDuration()
        );
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getDuration
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessDuration
     */
    public function testNoDuration()
    {
        // One step without start date
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                null,
                new \DateTime('+3 days')
            ),
        )));

        $this->assertEquals(
            0,
            $this->object->getDuration()
        );

        // One step without finish date
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('+3 days'),
                null
            ),
            $this->getMockedStep(
                new \DateTime('+5 days'),
                null
            ),
        )));

        $this->assertEquals(
            0,
            $this->object->getDuration()
        );

        // Steps without start or finish dates
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
            ),
            $this->getMockedStep(
            ),
        )));

        $this->assertEquals(
            0,
            $this->object->getDuration()
        );

        // No step
        $this->object->clearSteps();

        $this->assertEquals(
            0,
            $this->object->getDuration()
        );
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getStatus
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessStatus
     */
    public function testDraftStatus()
    {
        $this->markTestSkipped();
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getStatus
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessStatus
     */
    public function testScheduledStatus()
    {
        $this->markTestSkipped();
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getStatus
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessStatus
     */
    public function testInProgressStatus()
    {
        $this->markTestSkipped();
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getStatus
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessStatus
     */
    public function testDoneStatus()
    {
        $this->markTestSkipped();
    }

    /**
     * Get a mock Step object
     * @param \DateTime $startedAt
     * @param \DateTime $finishedAt
     * @return Step
     */
    private function getMockedStep(\DateTime $startedAt = null,
        \DateTime $finishedAt = null)
    {
        $step = $this->getMock(
            '\TWM\SiteBundle\Entity\Travel\Step\Step',
            array('getStartedAt', 'getFinishedAt')
        );

        if (!is_null($startedAt)) {
            $step->expects($this->any())
                ->method('getStartedAt')
                ->will($this->returnValue($startedAt));
        }

        if (!is_null($finishedAt)) {
            $step->expects($this->any())
                ->method('getFinishedAt')
                ->will($this->returnValue($finishedAt));
        }

        return $step;
    }
}
