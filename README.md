# Store API Assignment

## How to run?
  * `composer install`
  *  set .env values for database setup
  * `php artisan migrate`
  * `php artisan db:seed`(optional in case that test data needed)
  * `php -S localhost:8080 -t public`
  
## How to run the tests?
  * `vendor\bin\phpunit`
  *  For testing API by postman, simply port store.json in postman
