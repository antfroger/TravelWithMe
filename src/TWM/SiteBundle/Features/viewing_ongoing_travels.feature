Feature: Viewing the ongoing travels today

#  Scenario: Some travels are ongoing today
#    Given there are ongoing travels today
#    When I go to "/voyages/encours"
#    Then I should see the ongoing travels ordered by start date

  Scenario: No ongoing travels today
    Given There are no ongoing travels today
    When I go to "/voyages/encours"
    Then I should see "Pas de voyage en cours"