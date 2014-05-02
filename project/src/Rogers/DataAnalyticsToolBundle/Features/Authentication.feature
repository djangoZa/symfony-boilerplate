Feature: Authentication
    In order view the performance of my salons
    As a Salon Manager
    I need to login to the "Data Analytics Tool" website

    Background:
        Given the "ioffice" database is clean
        And the "users" table in the "ioffice" database has rows:
            | username | password                           | firstname     | lastname     |
            | test1    | $1$TLe.gahh$JCbO/Y/eg28FqdA7lFi0m. | testFirstName | testLastName |

    Scenario: Can be redirected to login if not authenticated
        Given I am logged out
        When I browse to "/dashboard"
        Then I expect to be redirected to "/authentication"

#    Scenario: Can input authentication details
#        Given I browsed to "/login"
#        When I want to supply my authenticated details
#        Then I expect there to be a way for me to introduce these details

#    Scenario: Can initiate authentication process
#        Given I am on the login page
#        When I have introduced my authentication details
#        Then I expect there to be a way for me to initiate the authentication process

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

#    Scenario: Can be automatically logged in if authentication details were persisted
#        Given I was previously authenticated
#        And I specified that I wanted my authentication to be persisted
#        When I browse to any page
#        Then I expect to be granted access automatically

#    Scenario: Can use same authentication details as iOffice
#        Given I am on the login page
#        When I want to supply my authenticated details
#        Then I expect that I am able to use the same authentication details that I use on iOffice

#    Scenario: Can be redirected if authentication is successful
#        Given I have introduced my authentication details
#        And I have initiated the authentication process
#        When my authentication details have been processed successfully
#        Then I expect to be redirected to the main dashboard"