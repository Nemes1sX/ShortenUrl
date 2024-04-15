# Shortcut URL
Laravel API + Vue web app generating shortcut URLs and using them to reach real origina, ones

# Prerequistes
* Make sure that localhost and mysql servers are up
* PHP version >=8.2, NodeJs 21.6.2 and Composer

# Installation instructions
* Made .env file with cmd terminal in the project folder ```copy .env.example .env```
* Install Laravel and other dependencies with ```composer require```
* Made app key ```php artisan key:generate```
* Migrate ```php artisan migrate```
* Install node_modules with ```npm install && npm run dev``` 
* Launch app ```php artisan serve``` & ```npm run dev```. The first one isn't neccessary if you using laragon.
