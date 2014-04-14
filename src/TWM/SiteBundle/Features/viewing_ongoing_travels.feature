Feature: Viewing the ongoing travels today

  Background:
    Given There is no "Travel\Travel\Travel" in database
    And There is no "Travel\Step\Step" in database

  Scenario: Some travels are ongoing today
    Given I have a travel "travel 1"
      And I have a step starting "-12 days" and finishing "+2 days"
      And I have a travel "travel 2"
      And I have a step starting "-2 days" and finishing "-1 day"
      And I have a step starting "-1 day" and finishing "+2 days"
      And I have a travel "travel 3"
      And I have a step starting "-10 days" and finishing "-5 days"
    When I add a step starting "-12 days" and finishing "+2 days" to travel "travel 1"
      And I add a step starting "-2 days" and finishing "-1 day" to travel "travel 2"
      And I add a step starting "-1 day" and finishing "+2 days" to travel "travel 2"
      And I add a step starting "-10 days" and finishing "-5 days" to travel "travel 3"
      And I go to "/voyages/encours"
    Then I should see the ongoing travels ordered by start date

  Scenario: No ongoing travels today
    Given There are no ongoing travels today
    When I go to "/voyages/encours"
    Then I should see "Pas de voyage en cours"