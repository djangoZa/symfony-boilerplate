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
        And I expect to be redirected to "/"

#    Scenario: Can be alerted when authentication details are invalid
#        Given I have initiated the authentication process
#        When my authentication details have been processed
#        And my authentication details are incorrect
#        Then I expect to see a message alerting me of this
#        And I expect to be able to re introduce my authentication details

#    Scenario: Can specify that authentication details are persisted
#        Given I am on the login page
#        When I have introduced my authentication details
#       Then I expect there to be a way for me to specify that I want my authentication persisted
#        And I expect my authentication details to be persisted if the authentication was successful

#    Scenario: Can be redirected to homepage is already logged in
#       Given I am logged in
#       When I browse to "/authentication"
#       Then I expect to be redirected to "/"

#    Scenario: Can be automatically logged in if authentication details were persisted
#        Given I was previously authenticated
#        And I specified that I wanted my authentication to be persisted
#        When I browse to any page
#        Then I expect to be granted access automatically

#    Scenario: Can be redirected if authentication is successful
#        Given I have introduced my authentication details
#        And I have initiated the authentication process
#        When my authentication details have been processed successfully
#        Then I expect to be redirected to the main dashboard"