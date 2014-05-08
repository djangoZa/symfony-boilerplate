<?php
namespace Rogers\DataAnalyticsToolBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Feature context.
 */
class MyBehatContext extends BehatContext implements KernelAwareInterface
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
        $container = $this->kernel->getContainer();
        $databaseService = $container->get('test.database.service');
        $databaseService->cleanDatabase($databaseName);
    }

    /**
     * @Given /^the "([^"]*)" table in the "([^"]*)" database has rows:$/
     */
    public function theTableInTheDatabaseHasRows($tableName, $databaseName, TableNode $rows)
    {
        $rows = $rows->getHash();
        $container = $this->kernel->getContainer();
        $databaseService = $container->get('test.database.service');
        $databaseService->populateDatabaseTableWithRows($databaseName, $tableName, $rows);
    }
}
