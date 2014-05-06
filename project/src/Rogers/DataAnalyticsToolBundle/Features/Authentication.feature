Feature: Authentication
    In order view the performance of my salons
    As a Salon Manager
    I need to login to the website

    Background:
        Given the "ioffice" database is clean
        And the "users" table in the "ioffice" database has rows:
            | accountID | username | passwordHash                                                 |
            | 1         | test1    | $2a$08$g11xPFJdehbL/9qxTprdeuYpWZtNnUvvTk5YIaRavoI3TFEKQSSUe |

    Scenario: Can be redirected to login if not authenticated
        Given I am logged out
        When I browse to "/"
        Then I expect to be redirected to "/authentication"

    Scenario: Can be presented with the necessary authentication fields
        Given I am logged out
        When I browse to "/authentication"
        Then I expect there to be a field named "username" of type "text"
        And I expect there to be a field named "password" of type "password"
        And I expect there to be a field named "remember" of type "checkbox"
        And I expect there to be a field named "login" of type "submit"

    Scenario: Can login with ioffice authentication details
        Given I am logged out
        And I browse to "/authentication"
        When I insert "test1" into the field named "username"
        And I insert "Supersalon1!" into the field named "password"
        And I click the field named "login"
        Then I expect to be redirected to "/"

    Scenario: Can be alerted when incorrect authentication details are supplied
        Given I am logged out
        And I browse to "/authentication"
        When I insert "test1" into the field named "username"
        And I insert "wrongPassword" into the field named "password"
        And I click the field named "login"
        Then I expect to be redirected to "/authentication"
        And I expect to see an alert message that says "Invalid authentication details have been supplied"

    Scenario: Can persist the values previously inserted into the fields
        Given I am logged out
        And I browse to "/authentication"
        When I insert "test1" into the field named "username"
        And I insert "wrongPassword" into the field named "password"
        And I check the "remember" field
        And I click the field named "login"
        Then I expect to be redirected to "/authentication"
        And I expect the "username" field has a value of "test1"
        And I expect the "password" field has a value of "wrongPassword"
        And I expect the "remember" field to be checked

    Scenario: Can remember a successful login
        Given I am logged out
        And I browse to "/authentication"
        And I insert "test1" into the field named "username"
        And I insert "Supersalon1!" into the field named "password"
        And I check the "remember" field
        And I click the field named "login"
        When I reset my browser session
        And I browse to "/"
        Then I expect to be on "/"
        And I expect there to be a cookie named "userId" of value "2"

    Scenario: Can be redirected to authentication if login was not remembered and the browser is reset
        Given I am logged out
        And I browse to "/authentication"
        And I insert "test1" into the field named "username"
        And I insert "Supersalon1!" into the field named "password"
        And I click the field named "login"
        When I reset my browser session
        And I browse to "/"
        Then I expect to be redirected to "/authentication"

    Scenario: Can delete the user cookie when logging out
        Given I am logged out
        And I browse to "/authentication"
        And I insert "test1" into the field named "username"
        And I insert "Supersalon1!" into the field named "password"
        And I check the "remember" field
        And I click the field named "login"
        When I log out
        Then I expect that there is not a cookie named "userId"