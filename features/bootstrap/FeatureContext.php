<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

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
    protected $params = null;

    protected $client = null;
    protected $results = null;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->params = $parameters;
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
     * @When /^I request a list of issues for the "([^"]*)" repository from user "([^"]*)"$/
     */
    public function iRequestAListOfIssuesForTheRepositoryFromUser($arg1, $arg2)
    {
        $issues = $this->client->issues()->all($arg1, $arg2);
        $statusCode   = $this->client->getHttpClient()->getLastResponse()->getStatusCode();

        if (200 != $statusCode) {
            throw new Exception("Expected a 200 status code but got $statusCode instead!");
        }

        $this->results = $issues;
    }

    /**
     * @Then /^I should get at least "([^"]*)" result$/
     */
    public function iShouldGetAtLeastResult($arg1)
    {
        if (count($this->results) < $arg1) {
            throw new Exception("Expected at least $arg1 result but got back " . count($this->results));
        }
    }

    /**
     * @Given /^I am an authenticated user$/
     */
    public function iAmAnAuthenticatedUser()
    {
        $this->client->authenticate($this->params['github_username'], $this->params['github_password'], Github\Client::AUTH_HTTP_PASSWORD);
    }

    /**
     * @When /^I request a list of my repositories$/
     */
    public function iRequestAListOfMyRepositories()
    {
        $repositories = $this->client->api('current_user')->repositories();

        $this->results = $repositories;
    }

    /**
     * @Then /^The results should include a repository named "([^"]*)"$/
     */
    public function theResultsShouldIncludeARepositoryNamed($arg1)
    {
        throw new PendingException();
    }
}
