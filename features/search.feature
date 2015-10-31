Feature: Search repositories
Scenario: I want to get a list of the repositories that reference monkeys
  Given I am an anonymous user
  When I search for the term "monkey"
  Then I should get at least one repository back
