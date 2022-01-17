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

<b>NOTE:</b> I don't have tests/bootstrap.php. I ran composer recipes:install phpunit/phpunit --force -v but I had the following erro.

![error](/public/error.jpg)

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