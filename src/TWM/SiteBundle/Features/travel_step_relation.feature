Feature: Travel Step Relation
  In order to set up a valid travels list
  As a developer
  I need a working relationship

  Background:
    Given There is no "Travel\Travel\Travel" in database
      And There is no "Travel\Step\Step" in database

  Scenario: A travel contains a step
    Given the following travels
      | id | name            |
      | 1  | travel number 1 |
      And the following steps
        | id | startedAt | finishedAt |
        | 1  | -12 days  | +2 days    |
    When I add step 1 to travel 1
    Then I should find step 1 in travel 1

  Scenario: A travel contains a step
    Given the following travels
      | id | name            |
      | 1  | travel number 1 |
      And the following steps
        | id | startedAt | finishedAt |
        | 1  | -4 days   | tomorrow   |
        | 2  | yesterday | +5 days    |
    When I add step 1 to travel 1
      And I add step 2 to travel 1
    Then I should find step 1 in travel 1
      And I should find step 2 in travel 1