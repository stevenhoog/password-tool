<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Return index view provided by GroupsController
Route::get('/', 'GroupsController@index')->name('index');

// Create CRUD routes for group
Route::resource('group', 'GroupsController')->except(['index']);

// Disable register route
Auth::Routes(['register' => false]);

// Create CRUD routes for login credentials
Route::resource('logins', 'LoginsController')->except(['index']);

// Return profile page with login credentials
Route::get('/profile', 'LoginsController@index')->name('profile');

