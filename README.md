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
## Must-have features
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
    - Start date (datetime)
    - End date (datetime)

## Installing Doctrine

        composer require symfony/orm-pack
        composer require --dev symfony/maker-bundle

[Reference](https://symfony.com/doc/current/doctrine.html)
## Start database

Create a schema

        php bin/console doctrine:database:create

Create an object and new table

        php bin/console make:entity

Then

        php bin/console make:migration

Then 

        php bin/console doctrine:migrations:migrate