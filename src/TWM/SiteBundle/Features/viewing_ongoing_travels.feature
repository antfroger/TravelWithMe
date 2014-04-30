Feature: Viewing the ongoing travels today

  Background:
    Given There is no "Travel\Travel\Travel" in database
    And There is no "Travel\Step\Step" in database

  Scenario: Some travels are ongoing today
    Given the following travels
      | id | name            |
      | 1  | travel number 1 |
      | 2  | travel number 2 |
      | 3  | travel number 3 |
      And the following steps
        | id | startedAt | finishedAt |
        | 1  | -12 days  | +2 days    |
        | 2  | -2 days   | +1 day     |
        | 3  | +1 day    | +4 days    |
        | 4  | -5 days   | +4 days    |
    When I add step 4 to travel 1
      And I add step 2 to travel 2
      And I add step 3 to travel 2
      And I add step 1 to travel 3
      And I go to "/voyages/encours"
    Then I should see 3 ongoing travels ordered by start date

  Scenario: No ongoing travels today
    Given There are no ongoing travels today
    When I go to "/voyages/encours"
    Then I should see "Pas de voyage en cours"