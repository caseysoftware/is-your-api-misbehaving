Feature: Watch a repository
  Scenario: I want to watch an important repository
    Given I am an authenticated user
    When I watch the "is-your-api-misbehaving" repository from user "caseysoftware"
    Then The "is-your-api-misbehaving" repository from user "caseysoftware" will list me as a watcher