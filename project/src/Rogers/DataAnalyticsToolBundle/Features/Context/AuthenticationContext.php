<?php
namespace Rogers\DataAnalyticsToolBundle\Features\Context;

use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Feature context.
 */
class AuthenticationContext extends RawMinkContext
{
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
     * @Given /^I am logged out$/
     */
    public function iAmLoggedOut()
    {
        $driver = $this->getSession()->getDriver();
        $driver->visit('/authentication/logout');
    }

    /**
     * @Given /^I am logged in with username "([^"]*)" and password "([^"]*)"$/
     */
    public function iAmLoggedInWithUsernameAndPassword($username, $password)
    {
        $driver = $this->getSession()->getDriver();

        //visit the login page
        $driver->visit('/authentication');

        //insert the username
        $element = array_pop($driver->find("//input[@name='username']"));
        $element->setValue($username);

        //insert the password
        $element = array_pop($driver->find("//input[@name='password']"));
        $element->setValue($password);

        //click the login button
        $driver->click("//input[@name='login']");
    }

    /**
     * @When /^I log out$/
     */
    public function iLogOut()
    {
        $driver = $this->getSession()->getDriver();
        $driver->visit('/authentication/logout');
    }
}
