Feature: Fork a repository
  Scenario: I want to fork an important repository
    Given I am an authenticated user
    When I fork the "is-your-api-misbehaving" repository from user "caseysoftware"
    And I request a list of my repositories
    Then The results should include a repository named "is-your-api-misbehaving"