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
        $this->useContext('WebUtilityContext', new WebUtilityContext($parameters));
        $this->useContext('ResourceUtilityContext', new ResourceUtilityContext($parameters));
        $this->useContext('AuthenticationContext', new AuthenticationContext($parameters));
        $this->useContext('HierarchyContext', new HierarchyContext($parameters));
    }
}