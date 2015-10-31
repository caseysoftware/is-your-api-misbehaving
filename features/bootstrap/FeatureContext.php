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
        throw new PendingException();
    }

    /**
     * @When /^I search for the term "([^"]*)"$/
     */
    public function iSearchForTheTerm($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should get at least one repository back$/
     */
    public function iShouldGetAtLeastOneRepositoryBack()
    {
        throw new PendingException();
    }
}
