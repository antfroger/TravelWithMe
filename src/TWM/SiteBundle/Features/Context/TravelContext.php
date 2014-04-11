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
}
