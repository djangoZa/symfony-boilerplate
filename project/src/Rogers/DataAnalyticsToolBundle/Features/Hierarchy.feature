Feature: Hierarchy
    In order to define the salon hierarchy for a group of salons
    As an Administrator
    I need to administer an n-tier hierarchy of salons

    Background:
        Given the "ioffice" database is clean
        And the "users" table in the "ioffice" database has rows:
            | userID    | username | passwordHash                                                 | status |
            | 1         | test1    | $2a$08$g11xPFJdehbL/9qxTprdeuYpWZtNnUvvTk5YIaRavoI3TFEKQSSUe | 1      |

    Scenario: Can add a top level group
        Given I am logged in with username "test1" and password "Supersalon1!"
#    Scenario: Can add a child group to a top level group
#    Scenario: Can add a child group to another child group
#    Scenario: Can add a salon to a top level group
#    Scenario: Can add a salon to a child group of a top level group
#    Scenario: Can add a salon to a child group of a child group
#    Scenario: Can view a nested list of groups and salons
#    Scenario: Can edit a top level group
#    Scenario: Can edit a child group
#    Scenario: Can move a child group to a sibling group
#    Scenario: Can move a child group to the child of a sibling group
#    Scenario: Can move a child group to another parent group
#    Scenario: Can move a top level group to a sibling group
#    Scenario: Can move a top level group to the child of a sibling group
#    Scenario: Can delete a child group
#    Scenario: Can delete a top level group