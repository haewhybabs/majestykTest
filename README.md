# Majestyk Test

## Introduction

### Laravel API on Github Users and the Repository


## Documentation
There are 6 endppoints for the API
**Fetch users** : get request to;   "servername"/api/users". (127.0.0.1:8000/api/users)

**Search User :** get request to ; "servername"/user/search , with **query** param  (127.0.0.1:8000/api/users)



## Installation
First remember to set up your env with the basic database creation

follow the following commands to get it started:

* git clone https://github.com/haewhybabs/majestykTest.git
* composer update (to install the laravel dependencies) 

* php artisan migrate --seed (to update your database with all the fields save the search type which can either be user or repository)

* php artisan fetch:data ( This is a command i created that fetches the data from the github and save it to the database)

* start the server with php artisan serve

## Author
**Ayobami Babalola**
