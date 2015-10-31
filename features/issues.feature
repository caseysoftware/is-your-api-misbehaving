Feature: Get a list of issues
  Scenario: I want to get a list of the issues for the Symfony repository
    Given I am an anonymous user
    When I request a list of issues for the Symfony repository
    Then I should get at least one issue back