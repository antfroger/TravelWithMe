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
use TWM\SiteBundle\Entity\Travel\Travel\Status;
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

        // Steps without finish date
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
        // Steps without start or finish dates
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
            ),
            $this->getMockedStep(
            ),
        )));

        $this->assertEquals(
            Status::DRAFT,
            $this->object->getStatus()
        );

        // No step
        $this->object->clearSteps();

        $this->assertEquals(
            Status::DRAFT,
            $this->object->getStatus()
        );
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getStatus
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessStatus
     */
    public function testScheduledStatus()
    {
        // One step without finish date and start date > now
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('+3 days'),
                null
            ),
        )));

        $this->assertEquals(
            Status::SCHEDULED,
            $this->object->getStatus()
        );

        // Steps in the future
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('+3 days'),
                new \DateTime('+5 days')
            ),
            $this->getMockedStep(
                new \DateTime('+5 days'),
                new \DateTime('+8 days')
            ),
        )));

        $this->assertEquals(
            Status::SCHEDULED,
            $this->object->getStatus()
        );
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getStatus
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessStatus
     */
    public function testInProgressStatus()
    {
        // One step without finish date and start date <= now
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('-3 days'),
                null
            ),
        )));

        $this->assertEquals(
            Status::IN_PROGRESS,
            $this->object->getStatus()
        );

        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('now'),
                null
            ),
        )));

        $this->assertEquals(
            Status::IN_PROGRESS,
            $this->object->getStatus()
        );

        // One step without start date and finish date > now
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                null,
                new \DateTime('+3 days')
            ),
        )));

        $this->assertEquals(
            Status::IN_PROGRESS,
            $this->object->getStatus()
        );

        // Ongoing steps
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('yesterday'),
                new \DateTime('+1 days')
            ),
            $this->getMockedStep(
                new \DateTime('+1 days'),
                new \DateTime('+4 days')
            ),
        )));

        $this->assertEquals(
            Status::IN_PROGRESS,
            $this->object->getStatus()
        );

        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('now'),
                new \DateTime('+1 days')
            ),
            $this->getMockedStep(
                new \DateTime('+1 days'),
                new \DateTime('+4 days')
            ),
        )));

        $this->assertEquals(
            Status::IN_PROGRESS,
            $this->object->getStatus()
        );

        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('-6 days'),
                new \DateTime('-2 days')
            ),
            $this->getMockedStep(
                new \DateTime('-2 days'),
                new \DateTime('now')
            ),
        )));

        $this->assertEquals(
            Status::IN_PROGRESS,
            $this->object->getStatus()
        );
    }

    /**
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::getStatus
     * @covers TWM\SiteBundle\Entity\Travel\Travel\Travel::guessStatus
     */
    public function testDoneStatus()
    {
        // One step without start date and finish date < now
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                null,
                new \DateTime('-1 days')
            ),
        )));

        $this->assertEquals(
            Status::DONE,
            $this->object->getStatus()
        );

        // Steps in the past
        $this->object->setSteps(new ArrayCollection(array(
            $this->getMockedStep(
                new \DateTime('-10 days'),
                new \DateTime('-6 days')
            ),
            $this->getMockedStep(
                new \DateTime('-6 days'),
                new \DateTime('-2 days')
            ),
        )));

        $this->assertEquals(
            Status::DONE,
            $this->object->getStatus()
        );
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
