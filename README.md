# symfony-tdd

## Learning objectives
- Ability to write and read unit tests
- Understanding the importance of Test Driven Development

## Installating PHPUnit

* install phpunit/phpunit and the symfony/test-pack
    
        composer require --dev phpunit/phpunit symfony/test-pack

* After the library is installed, try running PHPUnit:

        php ./vendor/bin/phpunit

Symfony Flex automatically creates phpunit.xml.dist and tests/bootstrap.php. If these files are missing, you can try running the recipe again using composer recipes:install phpunit/phpunit --force -v.

<b>NOTE:</b> After these steps I have test folder and these files in all projects that I did with symfony.

[Reference](https://symfony.com/doc/current/testing.html)

## Database

### Must-have features

Create the following entities
- User
    - password, email (if working with the login)
    - username OR email field (you can choose)
    - credit (integer, start credit 100)
    - premiumMember (bool, default false)
- Room
    - name
    - onlyForPremiumMembers (bool, default false)
- Bookings
    - Relation to room & User
    - Start date (date)
    - End date (date)
    - Start time (datetime)
    - End time (datetime)
### Installing Doctrine

        composer require symfony/orm-pack
        composer require --dev symfony/maker-bundle

[Reference](https://symfony.com/doc/current/doctrine.html)

### Start Database

Create a schema

        php bin/console doctrine:database:create

Create an object and new table

        php bin/console make:entity

Then

        php bin/console make:migration

Then 

        php bin/console doctrine:migrations:migrate

# Project

        php bin/console make:controller

Created:
* HomepageController.php 
* homepage folder 
* index.html.twig

## Test Conditions

The following conditions apply:

- Rooms marked as premium can only be hired for premium members <b>OK</b>
- No room can be booked for more than 4 hours <b>OK</b>
- Check if they can afford the rent for the room <b>OK</b>
- Room can only be booked if no other User has already booked it in this time (this is the most difficult condition) <b>OK</b>

## Edge cases

What is somebody needs all their credit to pay for a rental?
What if somebody enters an end date to start before the start date <b>OK</b>
What is the dates of 2 bookings match exactly.
What if somebody gives a negative number to addCredit (nice to have, see below)