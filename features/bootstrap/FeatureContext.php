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
    protected $client = null;
    protected $issues = null;

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
     * @When /^I request a list of issues for the Symfony repository$/
     */
    public function iRequestAListOfIssuesForTheSymfonyRepository()
    {
        $issues = $this->client->issues()->all("symfony", "symfony");
        $statusCode   = $this->client->getHttpClient()->getLastResponse()->getStatusCode();

        if (200 != $statusCode) {
            throw new Exception("Expected a 200 status code but got $statusCode instead!");
        }

        $this->issues = $issues;
    }

    /**
     * @Then /^I should get at least one issue back$/
     */
    public function iShouldGetAtLeastOneIssueBack()
    {
        throw new PendingException();
    }
}
