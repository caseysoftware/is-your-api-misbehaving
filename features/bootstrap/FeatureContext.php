<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use \Github\Client;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    protected $client = null;
    protected $repositories = null;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->client = new \Github\Client();
    }

    /**
     * @Given /^I am an anonymous user$/
     */
    public function iAmAnAnonymousUser()
    {
        // don't do anything here
    }

    /**
     * @When /^I search for the term "([^"]*)"$/
     */
    public function iSearchForTheTerm($arg1)
    {
        $repositories = $this->client->search()->repositories($arg1);
        $statusCode   = $this->client->getHttpClient()->getLastResponse()->getStatusCode();

        if (200 != $statusCode) {
            throw new Exception("Expected a 200 status code but got $statusCode instead!");
        }

        $this->repositories = $repositories;
    }

    /**
     * @Then /^I should get at least one repository back$/
     */
    public function iShouldGetAtLeastOneRepositoryBack()
    {
        if (0 == $this->repositories['total_count']) {
            throw new Exception("Expected at least one repository but got back zero.");
        }
    }
}
