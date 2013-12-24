Feature: Viewing the ongoing travels today

  Scenario: No ongoing travels today
    Given there are no ongoing travels today
    When I go to the ongoing travels display page
    Then I should see that there are no ongoing travels

  Scenario: Some travels are ongoing today
    Given there are ongoing travels today
    When I go to the ongoing travels display page
    Then I should see the ongoing travels ordered by start date
