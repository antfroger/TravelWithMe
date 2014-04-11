<?php

namespace TWM\SiteBundle\Features\Context;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\HttpKernel\KernelInterface;
//use Behat\Gherkin\Node\PyStringNode;
//use Behat\Gherkin\Node\TableNode;

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
    public function iShouldSee($key, $domain)
    {
        $container   = $this->kernel->getContainer();
        $translation = $container->get('translator')->trans(
            $key,
            array(),
            $domain
        );

        $this->assertResponseContains($translation);
    }
}
