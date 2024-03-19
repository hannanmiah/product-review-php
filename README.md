## Simple Product Review App Using raw php

This is a simple product review app using raw php. This app is developed
by [Hannan Miah](https://www.linkedin.com/in/hannanmiah).

## Features

- Laravel like folder configuration with basic routing, service container, facades and bootstrapping.
- Dynamic parameterized routing.
- Basic request validation.
- Basic MVC model micro framework
- Basic console command like laravel artisan
- Basic database connection and query builder
- Basic config and .env file handling

## Installation

- Clone the repository
- Run `composer install`
- Run `php -S localhost:8000 -t public` or setup this project in your local server (used apach2).
- Open your browser and go to `http://localhost:8000` or `http://localhost/{your_project_folder}` or your assigned
  virtual host.

## Environment Configuration

- Place .env file to your project root directory and set your database configuration.

```env 
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

- Run `php artisan migrate'

## Api Endpoints

- `/` - GET Home page
- `/reviews` - GET List of all reviews
- `/reviews/{id}` - GET Single review
- `/reviews` - POST review
- `/reviews/{id}` - PUT update review
- `/reviews/{id}` - DELETE delete review
