Feature: newUserRegistration

  @MAS-4
  Scenario: New User Registration
    Given I am on (/login) page
    When I write new name and password and password confirmation
    Then I get message about successfully registartion 
    And I am redirecting to (/home) page
