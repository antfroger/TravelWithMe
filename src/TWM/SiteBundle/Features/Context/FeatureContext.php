<?php

namespace TWM\SiteBundle\Features\Context;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpKernel\KernelInterface;
use TWM\SiteBundle\Entity\Travel\Step\Step;
use TWM\SiteBundle\Entity\Travel\Travel\Travel;
//use Behat\Gherkin\Node\PyStringNode;
//use Behat\Gherkin\Node\TableNode;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Feature context.
 */
class FeatureContext extends MinkContext implements KernelAwareInterface
{
    private $kernel;
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @When /^I go to "([^"]*)"$/
     */
    public function iGoTo($route)
    {
        $container = $this->kernel->getContainer();
        $this->visit(
            $container->get('router')->generate($route)
        );
    }

    /**
     * @Then /^I should see "([^"]*)"$/
     */
    public function iShouldSee($key)
    {
        $container = $this->kernel->getContainer();
        $container->get('translator')->trans($key);
    }

    /*
     * @todo
     * Move these methods in a specific class, TravelContext for example
     */

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
        $this->iShouldSee('ongoing.empty');
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
            assertEquals($elements[$key]->getText(), $travel->getName());
        }
    }
}
