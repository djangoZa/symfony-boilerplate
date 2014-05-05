<?php

namespace Rogers\DataAnalyticsToolBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//require_once 'PHPUnit/Autoload.php';
//require_once 'PHPUnit/Framework/Assert/Functions.php';
//

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
     * @Given /^the "([^"]*)" database is clean$/
     */
    public function theDatabaseIsClean($databaseName)
    {
        //throw new PendingException();
    }

    /**
     * @Given /^the "([^"]*)" table in the "([^"]*)" database has rows:$/
     */
    public function theTableInTheDatabaseHasRows($tableName, $databaseName, TableNode $rows)
    {
        //throw new PendingException();
    }

    /**
     * @Given /^I am logged out$/
     */
    public function iAmLoggedOut()
    {
        $driver = $this->getSession()->getDriver();
        $driver->visit('/authentication/logout');
    }

    /**
     * @When /^I browse to "([^"]*)"$/
     */
    public function iBrowseTo($url)
    {
        $driver = $this->getSession()->getDriver();
        $driver->visit($url);
    }

    /**
     * @When /^I insert "([^"]*)" into the field named "([^"]*)"$/
     */
    public function iInsertIntoTheFieldNamed($fieldValue, $fieldName)
    {
        $driver = $this->getSession()->getDriver();
        $element = array_pop($driver->find("//input[@name='$fieldName']"));
        $element->setValue($fieldValue);
    }

    /**
     * @When /^I click the field named "([^"]*)"$/
     */
    public function iClickTheFieldNamed($fieldName)
    {
        $driver = $this->getSession()->getDriver();
        $driver->click("//input[@name='$fieldName']");
    }

    /**
     * @Then /^I expect to be redirected to "([^"]*)"$/
     */
    public function iExpectToBeRedirectedTo($expectedUrl)
    {
        $session = $this->getSession();
        $asserter = $this->assertSession($session);
        $asserter->addressEquals($expectedUrl);
    }

    /**
     * @Then /^I expect there to be a field named "([^"]*)" of type "([^"]*)"$/
     */
    public function iExpectThereToBeAFieldNamedOfType($fieldName, $fieldType)
    {
        $session = $this->getSession();
        $asserter = $this->assertSession($session);
        $asserter->elementExists('xpath', "//input[@type='$fieldType' and @name='$fieldName']");
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
}
