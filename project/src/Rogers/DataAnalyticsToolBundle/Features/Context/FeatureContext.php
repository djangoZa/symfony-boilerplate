<?php
namespace Rogers\DataAnalyticsToolBundle\Features\Context;
use Behat\Behat\Context\BehatContext;

/**
 * Feature context.
 */
class FeatureContext extends BehatContext
{
    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->useContext('myMinkContext', new MyMinkContext($parameters));
        $this->useContext('myBehatContext', new MyBehatContext($parameters));
    }
}