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
class WebUtilityContext extends RawMinkContext
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
     * @Given /^I check the "([^"]*)" field$/
     */
    public function iCheckTheField($fieldName)
    {
        $driver = $this->getSession()->getDriver();
        $element = array_pop($driver->find("//input[@name='$fieldName']"));
        $element->check();
    }

    /**
     * @Given /^I expect the "([^"]*)" field to be checked$/
     */
    public function iExpectTheFieldToBeChecked($fieldName)
    {
        $session = $this->getSession();
        $driver = $session->getDriver();
        $asserter = $this->assertSession($session);
        $element = array_pop($driver->find("//input[@name='$fieldName']"));
        $asserter->checkboxChecked($fieldName, $element);
    }

    /**
     * @Given /^I expect there to be a cookie named "([^"]*)" of value "([^"]*)"$/
     */
    public function iExpectThereToBeACookieNamedOfValue($cookieName, $cookieValue)
    {
        $session = $this->getSession();
        $asserter = $this->assertSession($session);
        $asserter->cookieEquals($cookieName, $cookieValue);
    }

    /**
     * @Given /^I expect that there is not a cookie named "([^"]*)"$/
     */
    public function iExpectThatThereIsNotACookieNamed($cookieName)
    {
        $session = $this->getSession();
        $asserter = $this->assertSession($session);
        $asserter->cookieNotExists($cookieName);
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
     * @When /^I reset my browser session$/
     */
    public function iResetMyBrowserSession()
    {
        $session = $this->getSession();
        
        //get the user id before we reset the session - because resetting sessions in behat causes cookies to get killed
        $cookieKey = 'userAuthentication';
        $authenticationDetails = $session->getCookie($cookieKey);

        //reset session
        $session->reset();

        //set the cookie again
        $session->setCookie($cookieKey, $authenticationDetails);
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

    /**
     * @Then /^I expect the "([^"]*)" field has a value of "([^"]*)"$/
     */
    public function iExpectTheFieldHasAValueOf($fieldName, $fieldValue)
    {
        $session = $this->getSession();
        $driver = $session->getDriver();
        $asserter = $this->assertSession($session);
        $element = array_pop($driver->find("//input[@name='$fieldName']"));
        $asserter->fieldValueEquals($fieldName, $fieldValue, $element);
    }

    /**
     * @Then /^I expect to see an alert message that says "([^"]*)"$/
     */
    public function iExpectToSeeAnAlertMessageThatSays($message)
    {
        $session = $this->getSession();
        $asserter = $this->assertSession($session);
        $asserter->elementContains('xpath', "//div[@class='alert alert-danger']", $message);
    }

    /**
     * @Then /^I expect to be on "([^"]*)"$/
     */
    public function iExpectToBeOn($expectedUrl)
    {
        $session = $this->getSession();
        $asserter = $this->assertSession($session);
        $asserter->addressEquals($expectedUrl);
    }
}
