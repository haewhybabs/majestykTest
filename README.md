# Majestyk Test

## Introduction

### Laravel API on Github Users and the Repository


## Installation

### Note Authentication is required for github token, just add your personal access token to the env as stated in env_example as GITHUB_TOKEN
First remember to set up your env with the basic database creation

follow the following commands to get it started:

* git clone https://github.com/haewhybabs/majestykTest.git
* composer update (to install the laravel dependencies) 

* php artisan migrate --seed (to update your database with all the fields save the search type which can either be user or repository)

* php artisan fetch:data ( This is a command i created that fetches the data from the github and save it to the database)

* start the server with php artisan serve



## Documentation
There are 6 endppoints for the API
**Fetch users** : get request to;   "servername"/api/users" (127.0.0.1:8000/api/users)

**Search User :** get request to ; "servername"/user/search using **query** as the parameter  (http://127.0.0.1:8000/api/user/search?query=go)

**Getuser by id** : get request to;   "servername"/api/user/{id}" (127.0.0.1:8000/api/user/1)

**Fetch Repository** : get request to;   "servername"/api/repo/{user_id}" (127.0.0.1:8000/api/repo/1)

**Search Repository :** get request to ; "servername"/repo/search using **query** and **user_id** as the parameters
(http://127.0.0.1:8000/api/repo/search?query=go&user_id=1)

**Most Popular** : get request to;   "servername"/api/user/popular/date" (127.0.0.1:8000/api/user/popular/date)


## Architecture 
 
 #### Model
 The api uses 5 models

  **Repository** 

        user has many repository and are stored in that format with the user_id as the foreign key

  **User**

        Basic details of the user required

  **SearchLogging**

        This is to log every search request, a search logging could have many search results

  **SearchResult**

          This is to log the results of the search which belongs to the searchloggin, using log_id as the foreign key

  **SearchType**

          This is to differentiate the type of search whether repository search or user search


### Note Authentication might be required for the github api if you have exceeded the rate limit

## Author
**Ayobami Babalola**
