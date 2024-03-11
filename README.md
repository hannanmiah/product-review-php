## Simple Product Review App Using raw php

This is a simple product review app using raw php. This app is developed
by [Hannan Miah](https://www.facebook.com/dark.d3vi1).

## Features

- Laravel like folder configuration with basic routing, container and bootstrapping.
- Dynamic parameterized routing.
- Basic request validation.
- Basic MVC model micro framework

## Installation

- Clone the repository
- Run `composer install`
- Run `php -S localhost:8000 -t public` or setup this project in your local server (used apach2).
- Open your browser and go to `http://localhost:8000` or `http://localhost/{your_project_folder}` or your assigned
  virtual host.

## Api Endpoints

- `/` - GET Home page
- `/reviews` - GET List of all reviews
- `/reviews/{id}` - GET Single review
- `/reviews` - POST review
- `/reviews/{id}` - PUT update review
- `/reviews/{id}` - DELETE delete review
