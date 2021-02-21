# CISCO Router Management 

> A Laravel Auth and Router Management Rest API

## Features

- Laravel 8.0
- Display only the first 6 products with images and amounts.
- Sort option based on prize low to high or high to low.
- Filter option based on the product category.
- Convert currency from local or select currency rates.

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

### Secrets Generation

You create a new project starting from this repository, the _php artisan jwt:generate_ command will be executed.


### Libraries
- Composer (to autoload the libraries listed below) - https://getcomposer.org/
- nategood/httpful (to make API calls) - https://github.com/nategood/httpful
- ######## symfony twig(templating) -  http://twig.sensiolabs.org/documentation #######
- Laravel blade(templating)
- twitter bootstrap (to represent data) - http://getbootstrap.com/


## Installation

- `git clone https://github.com/ashishnimrot/EcommerceLaravel.git`
- `cd EcommerceLaravel`
- `composer install`
-  Edit `.env` and set your database connection details 
- `php artisan key:generate`
- `php artisan migrate:fresh --seed`


## Usage

#### Development

```bash
# serve on browser
php artisan serve
```
