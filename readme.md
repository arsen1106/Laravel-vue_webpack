
# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


Clone the repository

    git clone git@github.com:gothinkster/laravel-realworld-example-app.git

Switch to the repo folder

    cd laravel-vue

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    
Run the database seeder and you're done

    php artisan db:seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:gothinkster/laravel-realworld-example-app.git
    cd laravel-vue
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan jwt:generate
    php artisan migrate
    php artisan db:seed
    php artisan serve
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

---------

# Install Vue Webpack

## Dependencies

Switch to the repo folder

    cd vue-webpack
    
Install all the dependencies using npm

    npm install
    
Start the project

    npm start

##Admin Access

    email:admin@gmail.com
    password:123456

## Backend Folders 

- `app/Models` - Contains all the API Eloquent models
- `app` - Contains all the Web Eloquent models
- `app/Http/Controllers/Backend` - Contains all the Web controllers
- `app/Http/Middleware` - Contains the JWT auth middleware
- `app/Rest/version/v{/d}` - Contains all the api controllers
- `app/Services` - Contains all services
- `app/Validators` - Contains all models validators
- `app/Notifications` - Contains all notifications
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes/api.php` - Contains all the api routes
- `routes/web.php` - Contains all the web routes
- `routes/channels.php` - Contains all the event channels rules

## Frontend Folders 
- `config` - Contains all the webpack configuration files
- `build` - Contains all the webpack build files
- `static` - Contains all the webpack assets files (css/scss/sass/js/fonts/images)
- `src` - Contains all the webpack resource
- `src/main.js` - Starting  file 
- `src/assets` - Contains all the webpack them assets files
- `src/auth` - Contains vue-auth using jwt file
- `src/router` - Contains vue-router file described all routes
- `src/store` - Contains  all vuex files as modules
- `src/components` - Contains  all components




The api can now be accessed at

    http://localhost:8000/api/v1/

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|
| Optional 	| Authorization    	| Token {JWT}      	|

Refer the [api specification](#api-specification) for more info.

----------
 
# Authentication
 
This applications uses JSON Web Token (JWT) to handle authentication. The token is passed with each request using the `Authorization` header with `Token` scheme. The JWT authentication middleware handles the validation and authentication of the token. Please check the following sources to learn more about JWT.
 
- https://jwt.io/introduction/
- https://self-issued.info/docs/draft-ietf-oauth-json-web-token.html

----------

# Cross-Origin Resource Sharing (CORS)
 
This applications has CORS enabled by default on all API endpoints. The default configuration allows requests from `http://localhost:3000` and `http://localhost:4200` to help speed up your frontend testing. The CORS allowed origins can be changed by setting them in the config file. Please check the following sources to learn more about CORS.
 
- https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
- https://en.wikipedia.org/wiki/Cross-origin_resource_sharing
- https://www.w3.org/TR/cors
