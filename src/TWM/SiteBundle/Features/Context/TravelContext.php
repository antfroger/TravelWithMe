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

    private $travels;

    /**
     * @Given /^there are no ongoing travels today$/
     */
    public function thereAreNoOngoingTravelsToday()
    {
    }

    /**
     * @When /^I go to the ongoing travels display page$/
     */
    public function iGoToTheOngoingTravelsDisplayPage()
    {
        $this->iGoTo('twm_site_ongoing_travel');
    }

    /**
     * @Then /^I should see that there are no ongoing travels$/
     */
    public function iShouldSeeThatThereAreNoOngoingTravels()
    {
        $this->iShouldSee('ongoing.empty', 'travel');
    }

    /**
     * @Given /^there are ongoing travels today$/
     */
    public function thereAreOngoingTravelsToday()
    {
        $travel1 = new Travel();
        $travel1
            ->setName('travel1')
            ->setSteps(new ArrayCollection(array(
                new Step(
                    new \DateTime('-12 days'),
                    new \DateTime('+ 2 days')
                )
            )));

        $travel2 = new Travel();
        $travel2
            ->setName('travel2')
            ->setSteps(new ArrayCollection(array(
                new Step(
                    new \DateTime('yesterday'),
                    new \DateTime('+ 3 days')
                )
            )));

        $this->travels = new ArrayCollection(array(
            $travel1,
            $travel2
        ));
    }

    /**
     * @Then /^I should see the ongoing travels ordered by start date$/
     */
    public function iShouldSeeTheOngoingTravelsOrderedByStartDate()
    {
        $this->assertNumElements($this->travels->count(), 'li.travel');
        $elements = $this->getSession()->getPage()->findAll('css', 'li.travel');

        foreach ($this->travels as $key => $travel) {
            \PHPUnit_Framework_Assert::assertEquals($elements[$key]->getText(), $travel->getName());
        }
    }

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
            if ($stepStartDate == $step->getStartedAt() && $stepEndDate == $step->getFinishedAt()) {
                $found = true;
                break;
            }
        }

        \PHPUnit_Framework_Assert::assertTrue($found);
    }
}
