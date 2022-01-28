<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'App\Http\Controllers\UserController@list');
Route::get('user/search', 'App\Http\Controllers\UserController@search');
Route::get('user/{id}', 'App\Http\Controllers\UserController@userById');
Route::get('user/popular/date', 'App\Http\Controllers\UserController@mostPopular');
Route::get('repos/{id}', 'App\Http\Controllers\RepositoryController@getRepos');
Route::get('repo/search', 'App\Http\Controllers\RepositoryController@search');
