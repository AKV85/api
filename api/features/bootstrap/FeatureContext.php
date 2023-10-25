<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

        /**
     * @Given I am unauthenticated user
     */
    public function iAmUnauthenticatedUser()
    {
        throw new PendingException();
    }

    /**
     * @When I request a list of companies from :arg1 with GET method
     */
    public function iRequestAListOfCompaniesFromWithGetMethod($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then The results schould include all companies in company table
     */
    public function theResultsSchouldIncludeAllCompaniesInCompanyTable()
    {
        throw new PendingException();
    }
}
