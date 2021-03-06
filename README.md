# CISCO Router Management 

> A Laravel Auth and Router Management Rest API

<p align="center">
    <img src="https://github.com/ashishnimrot/cisco_router_management/blob/main/Login.png">
    <img src="https://github.com/ashishnimrot/cisco_router_management/blob/main/Filters.png">
</p>

## Features

- Laravel 8.0
- Vue 2.6

## Main Features

### Authentication Controllers

For each controller there's an already setup route in `routes/api.php` file:
##### UserController
* `POST api/auth/login`, to do the login and get your access token;
* `POST api/auth/refresh`, to refresh an existent access token by getting a new one;
* `POST api/auth/register`, to create a new user into your application;
* `POST api/auth/logout`, to log out the user by invalidating the passed token;
* `GET api/auth/profile`, to get current user data;
* `POST api/auth/profile`, to update current user data;

##### RouterController
* `POST api/router/filter`, to get router data with multiple filter, pagination;
* `GET api/router`, to get all router data;
* `POST api/router`, to create a new router;
* `PUT api/router/:id`, to update current user data;
* `DELETE api/router/:id`, to update current user data;
* `DELETE api/router/update/:id`, to update current user data;

### Secrets Generation Server

You create a new project starting from this repository, the _php artisan jwt:generate_ command will be executed.

## Installation Server

- `git clone https://github.com/ashishnimrot/cisco_router_management.git`
- `cd cisco_router_management/server`
- `cp .env.example .env`
- `composer install`
-  Edit `.env` and set your database connection details 
- `php artisan key:generate`
- `php artisan jwt:secret`
- `php artisan migrate:fresh --seed`
- `php artisan generate-data:router 100`

## Usage

#### Development Server

```bash
# serve on browser
php artisan serve
```

#### Testing Server

```bash
php artisan test
```

# Cliet CISCO Router Management

## Project setup

- `cd cisco_router_management/client`
- `npm install`


### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).

##
This will create a new user that you can use to sign in :
```yml
email: ashish.nimrot@world.com
password: password
```


