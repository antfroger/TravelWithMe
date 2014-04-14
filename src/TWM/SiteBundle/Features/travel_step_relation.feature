Feature: Travel Step Relation
  In order to set up a valid travels list
  As a developer
  I need a working relationship

  Background:
    Given There is no "Travel\Travel\Travel" in database
    And There is no "Travel\Step\Step" in database

  Scenario: A travel contains a step
    Given I have a travel "travel 1"
      And I have a step starting "-12 days" and finishing "+2 days"
    When I add a step starting "-12 days" and finishing "+2 days" to travel "travel 1"
    Then I should find step starting "-12 days" and finishing "+2 days" in travel "travel 1"

  Scenario: A travel contains a step
    Given I have a travel "travel 2"
      And I have a step starting "-4 days" and finishing "tomorrow"
      And I have a step starting "yesterday" and finishing "+3 days"
    When I add a step starting "-4 days" and finishing "tomorrow" to travel "travel 2"
      And I add a step starting "yesterday" and finishing "+3 days" to travel "travel 2"
    Then I should find step starting "-4 days" and finishing "tomorrow" in travel "travel 2"
      And I should find step starting "yesterday" and finishing "+3 days" in travel "travel 2"
