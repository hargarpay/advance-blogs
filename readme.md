# Building An Advance Blog With Pusher

### Kindly follow the instructions sequentially

## Requirement
- Ensure you have [composer install](https://getcomposer.org/)
- Ensure you php >= 5.6.7
- Settup a [pusher account](https://pusher.com/)

## Populate the .env variables
- Make a copy .env.example and name it .env
- Fill the following field in the .env file
- - DB_DATABASE
- - DB_USERNAME
- - DB_PASSWORD
- - PUSHER_APP_CLUSTER
- - PUSHER_APP_ID
- - PUSHER_APP_KEY
- - PUSHER_APP_SECRET

## Command run in terminal to set up the project
- change to the project folder and run the following in a command prompt for window or terminal for mac or linux
- Run `composer install` inside the project fold to install the composer package
- Run `php artisan fix:pusher` to fix library issue
- Run `php artisan migrate` to create the tables
- Run `php artisan db:seed` to populate the database
- Run `php artisan key:generate` to generate application key
- In the .env file set BROADCAST_DRIVER to `pusher` that is `BROADCAST_DRIVER=pusher`

## Added Feature
- JWT Authentication
- Websocket
- Role and permission

## Upcoming Features
- Using Beanstalkd and Supervisor to add job query

## Technology
- Laravel 5.4
- Vue
- Pusher
- JWT
- JQuery
- PHP
- Bootstrap
- MYSQL
- Javascript
