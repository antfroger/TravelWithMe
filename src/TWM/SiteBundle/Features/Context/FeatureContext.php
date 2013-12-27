<?php

namespace TWM\SiteBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
//use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;
//use Behat\Gherkin\Node\PyStringNode;
//use Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Feature context.
 */
class FeatureContext extends BehatContext implements KernelAwareInterface
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
        $container->get('router')->generate($route);
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
     * Move these methods in a specific class, TravelContext for example
     */

    /**
     * @Given /^there are no ongoing travels today$/
     */
    public function thereAreNoOngoingTravelsToday()
    {
        // FIXME
//        throw new PendingException();
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
        throw new PendingException();
    }

    /**
     * @Then /^I should see the ongoing travels ordered by start date$/
     */
    public function iShouldSeeTheOngoingTravelsOrderedByStartDate()
    {
        throw new PendingException();
    }
}
