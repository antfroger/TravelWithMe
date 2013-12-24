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

//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        $container = $this->kernel->getContainer();
//        $container->get('some_service')->doSomethingWith($argument);
//    }
//

    /**
     * @Given /^there are no ongoing travels today$/
     */
    public function thereAreNoOngoingTravelsToday()
    {
        throw new PendingException();
    }

    /**
     * @When /^I go to the ongoing travels display page$/
     */
    public function iGoToTheOngoingTravelsDisplayPage()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should see that there are no ongoing travels$/
     */
    public function iShouldSeeThatThereAreNoOngoingTravels()
    {
        throw new PendingException();
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
