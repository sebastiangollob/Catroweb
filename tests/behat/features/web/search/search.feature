@web @search
Feature: Searching for programs

  Background:
    Given there are users:
      | id | name     |
      | 1  | Catrobat |
      | 2  | User1    |
    And there are extensions:
      | id | internal_title |
      | 1  | arduino        |
      | 2  | drone          |
      | 3  | mindstorms     |
      | 4  | phiro          |
      | 5  | raspberry_pi   |
    And there are tags:
      | internal_title | title_ltm_code |
      | game           | __Spiel        |
      | animation      | __Animation    |
      | story          | __Geschichte   |
    And there are projects:
      | id | name                | description | owned by | tags             | extensions | upload time      | version |
      | 1  | program 1           | p1          | User1    | game             | arduino    | 22.04.2014 12:00 | 0.8.5   |
      | 2  | test program        |             | User1    | animation        | arduino    | 22.04.2014 13:00 | 0.8.5   |
      | 3  | Test advanced app   |             | Catrobat | story            | drone      | 22.04.2014 14:00 | 0.8.5   |
      | 4  | Catrobat            | my program  | User1    | story            | mindstorms | 22.04.2014 14:00 | 0.8.5   |
      | 5  | project 3           | mindstorms  | Catrobat | game, animation  | phiro      | 22.04.2014 14:00 | 0.8.5   |
      | 6  | test advanced games |             | User1    | animation, story | mindstorms | 22.04.2014 14:00 | 0.8.5   |
      | 7  | test                |             | Catrobat | story, animation | mindstorms | 22.04.2014 14:00 | 0.8.5   |
      | 8  | project test        | catrobat    | User1    | game             | drone      | 22.04.2014 14:00 | 0.8.5   |
    And I wait 1000 milliseconds


  Scenario: search for programs, which contain the word "program"
    Given I am on "/app/search/program"
    And I wait for the page to be loaded
    Then I should see "Your search returned 3 results"
    Then I should see "program 1"
    Then I should see "test program"
    Then I should see "Catrobat"

  Scenario: search for programs, which contain the word "Test"
    Given I am on "/app/search/Test"
    And I wait for the page to be loaded
    Then I should see "Your search returned 5 results"
    Then I should see "test advanced games"
    Then I should see "test advanced app"
    Then I should see "test program"
    Then I should see "test"
    Then I should see "project test"

  Scenario: search for programs, which contain the word "test advanced"
    Given I am on "/app/search/Test%20advanced"
    And I wait for the page to be loaded
    Then I should see "Your search returned 2 results"
    Then I should see "test advanced games"
    Then I should see "test advanced app"

  Scenario: search for projects, which contain the word "game"
    Given I am on "/app/search/game"
    And I wait for the page to be loaded
    Then I should see "Your search returned 4 results"
    Then I should see "test advanced games"
    Then I should see "program 1"
    Then I should see "project 3"
    Then I should see "project test"

  Scenario: search for projects, which contain the word "program and app"
    Given I am on "/app/search/program%20and%20app"
    And I wait for the page to be loaded
    Then I should see "Your search returned 0 results"

  Scenario: search for projects, which contain the word "mindstorms"
    Given I am on "/app/search/mindstorms"
    And I wait for the page to be loaded
    Then I should see "Your search returned 4 results"
    Then I should see "Test advanced games"
    Then I should see "Catrobat"
    Then I should see "project 3"
    Then I should see "test"

  Scenario: search for gmail should find no program
    Given I am on "/app/search/gmail"
    And I wait for the page to be loaded
    Then I should see "Your search returned 0 results"

  Scenario: search for gmx should find no program
    Given I am on "/app/search/gmx.at"
    And I wait for the page to be loaded
    Then I should see "Your search returned 0 results"
