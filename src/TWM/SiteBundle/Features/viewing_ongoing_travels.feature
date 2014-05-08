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
      | 4  | travel number 4 |
      | 5  | travel number 5 |
      And the following steps
        | id | startedAt | finishedAt |
        | 1  | -12 days  | +2 days    |
        | 2  | -2 days   | +1 day     |
        | 3  | +1 day    | +4 days    |
        | 4  | -5 days   | +4 days    |
        | 5  | +10 days  | +14 days   |
        | 6  | -4 days   | -1 day     |
    When I add step 4 to travel 1
      And I add step 2 to travel 2
      And I add step 3 to travel 2
      And I add step 1 to travel 3
      And I add step 6 to travel 4
      And I add step 5 to travel 5
      And I go to "/voyages/encours"
    Then I should see 3 ongoing travels ordered by start date

  Scenario: No ongoing travels today
    Given the following travels
      | id | name            |
      | 1  | travel number 1 |
      | 2  | travel number 2 |
      And the following steps
        | id | startedAt | finishedAt | travelId |
        | 1  | -5 days   | +2 days    | 1        |
        | 2  | -3 days   | -1 day     | 2        |
        | 3  | -1 day    | +4 days    | 2        |
      And There are no ongoing travels today
    When I go to "/voyages/encours"
    Then I should see "Pas de voyage en cours"