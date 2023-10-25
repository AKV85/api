Feature: List of companies
    Scenario: I want to see  a list of companies
        Given I am unauthenticated user
        When I request a list of companies from "http://localhost/companies" with GET method
        Then The results schould include all companies in company table