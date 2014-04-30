<?php

/**
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Features\Context;

use Behat\Gherkin\Node\TableNode;
use Doctrine\ORM\Mapping\ClassMetadata;
use TWM\SiteBundle\Entity\Travel\Step\Step;
use TWM\SiteBundle\Entity\Travel\Travel\Travel;

/**
 * Context class for travels
 */
class TravelContext extends FeatureContext
{
    /**
     * @Transform /^table:id,name$/
     */
    public function castTravelsTable(TableNode $travelsTable)
    {
        $travels = array();
        foreach ($travelsTable->getHash() as $travelHash) {
            $travel = new Travel();
            $travel->setName($travelHash['name']);

            // Property id is protected, use reflection to set this property for the tests
            $reflClass = new \ReflectionClass($travel);
            $reflProperty = $reflClass->getProperty('id');
            $reflProperty->setAccessible(true);
            $reflProperty->setValue($travel, $travelHash['id']);

            $travels[] = $travel;
        }

        return $travels;
    }

    /**
     * @Transform /^table:id,startedAt,finishedAt$/
     */
    public function castStepsTable(TableNode $stepsTable)
    {
        $steps = array();
        foreach ($stepsTable->getHash() as $stepHash) {
            $step = new Step();
            $step->setStartedAt(new \DateTime($stepHash['startedAt']));
            $step->setFinishedAt(new \DateTime($stepHash['finishedAt']));

            // Property id is protected, use reflection to set this property for the tests
            $reflClass = new \ReflectionClass($step);
            $reflProperty = $reflClass->getProperty('id');
            $reflProperty->setAccessible(true);
            $reflProperty->setValue($step, $stepHash['id']);

            $steps[] = $step;
        }

        return $steps;
    }

    /**
     * @Given /^the following travels|steps$/
     */
    public function pushObjects(array $objects)
    {
        if (0 === count($objects)) {
            return;
        }

        $em = $this->getEntityManager();

        foreach ($objects as $object) {
            $em->persist($object);

            // Force the id
            $metadata = $em->getClassMetaData(get_class($object));
            $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        }

        $this->getEntityManager()->flush();
    }

    /**
     * @When /^I add step (\d+) to travel (\d+)$/
     */
    public function iAddStepToTravel($stepId, $travelId)
    {
        // fixme repositories should be services

        /** @var Travel $travel */
        $travel = $this->getRepository('TWMSiteBundle:Travel\Travel\Travel')->findOneById($travelId);
        /** @var Step $step */
        $step   = $this->getRepository('TWMSiteBundle:Travel\Step\Step')->findOneById($stepId);

        $travel->addStep($step);

        $this->getEntityManager()->persist($step);
        $this->getEntityManager()->flush();
    }

    /**
     * @Then /^I should find step (\d+) in travel (\d+)$/
     */
    public function iShouldFindStepInTravel($stepId, $travelId)
    {
        /** @var Travel $travel */
        $travel = $this->getRepository('TWMSiteBundle:Travel\Travel\Travel')->findOneById($travelId);
        $steps  = $travel->getSteps();

        $found = false;
        foreach ($steps as $step) {
            if ($step->getId() === $stepId) {
                $found = true;
                break;
            }
        }

        \PHPUnit_Framework_Assert::assertTrue($found);
    }

    /**
     * @Given /^There are no ongoing travels today$/
     */
    public function thereAreNoOngoingTravelsToday()
    {
        $travels = $this->getEntityManager()
            ->getRepository('TWMSiteBundle:Travel\Travel\Travel')
            ->findOngoingTravels();

        foreach ($travels as $travel) {
            $this->getEntityManager()->remove($travel);
        }

        $this->getEntityManager()->flush();
    }

    /**
     * @Then /^I should see (\d+) ongoing travels? ordered by start date$/
     */
    public function iShouldSeeTheOngoingTravelsOrderedByStartDate($travelCount)
    {
        $travels = $this->getEntityManager()
            ->getRepository('TWMSiteBundle:Travel\Travel\Travel')
            ->findOngoingTravels();

        $this->assertNumElements(count($travels), 'li.travel');
        $elements = $this->getSession()->getPage()->findAll('css', 'li.travel');

        \PHPUnit_Framework_Assert::assertEquals($travelCount, count($elements));

        foreach ($travels as $key => $travel) {
            \PHPUnit_Framework_Assert::assertEquals($elements[$key]->getText(), $travel->getName());
        }
    }
}
