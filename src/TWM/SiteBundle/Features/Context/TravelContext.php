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

use Doctrine\Common\Collections\ArrayCollection;
use TWM\SiteBundle\Entity\Travel\Step\Step;
use TWM\SiteBundle\Entity\Travel\Travel\Travel;

/**
 * Context class for travels
 */
class TravelContext extends FeatureContext
{

    /**
     * @Given /I have a travel "([^"]*)"/
     */
    public function iHaveATravel($name)
    {
        $travel = new Travel();
        $travel->setName($name);

        $this->getEntityManager()->persist($travel);
        $this->getEntityManager()->flush();
    }

    /**
     * @Given /I have a step starting "([^"]*)" and finishing "([^"]*)"/
     */
    public function iHaveAProduct($startDate, $endDate)
    {
        $step = new Step(
            new \DateTime($startDate),
            new \DateTime($endDate)
        );

        $this->getEntityManager()->persist($step);
        $this->getEntityManager()->flush();
    }

    /**
     * @When /I add a step starting "([^"]*)" and finishing "([^"]*)" to travel "([^"]*)"/
     */
    public function iAddStepToTravel($stepStartDate, $stepEndDate, $travelName)
    {
        $travel = $this->getRepository('TWMSiteBundle:Travel\Travel\Travel')->findOneByName($travelName);
        $step   = $this->getRepository('TWMSiteBundle:Travel\Step\Step')->findOneBy(array(
            'startedAt'  => new \DateTime($stepStartDate),
            'finishedAt' => new \DateTime($stepEndDate),
            'travel'     => null
        ));

//        $step->setTravel($travel); // FIXME : travel properties startedAt, finishedAt and duration are null
        $travel->addStep($step);

        $this->getEntityManager()->persist($step);
        $this->getEntityManager()->flush();
    }

    /**
     * @Then /I should find step starting "([^"]*)" and finishing "([^"]*)" in travel "([^"]*)"/
     */
    public function iShouldFindProductInCategory($stepStartDate, $stepEndDate, $travelName)
    {
        $travel = $this->getRepository('TWMSiteBundle:Travel\Travel\Travel')->findOneByName($travelName);
        $steps = $travel->getSteps();

        $stepStartDate = new \DateTime($stepStartDate);
        $stepEndDate   = new \DateTime($stepEndDate);

        $found = false;
        foreach ($steps as $step) {
            // @fixme often fail but not every time
            if ($stepStartDate == $step->getStartedAt() && $stepEndDate == $step->getFinishedAt()) {
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
     * @Then /^I should see the ongoing travels ordered by start date$/
     */
    public function iShouldSeeTheOngoingTravelsOrderedByStartDate()
    {
        $travels = $this->getEntityManager()
            ->getRepository('TWMSiteBundle:Travel\Travel\Travel')
            ->findOngoingTravels();

        $this->assertNumElements(count($travels), 'li.travel');
        $elements = $this->getSession()->getPage()->findAll('css', 'li.travel');

        foreach ($travels as $key => $travel) {
            \PHPUnit_Framework_Assert::assertEquals($elements[$key]->getText(), $travel->getName());
        }
    }
}
