Feature: Create a repository
  Scenario: I want to create a new repository
    Given I am an authenticated user
    When I create the "monkey" repository
    And I request a list of my repositories
    Then The results should include a repository named "monkey"