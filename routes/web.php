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

// Create CRUD routes
Route::resource('group', 'GroupsController')->except(['index']);


// Disable register route
Auth::Routes(['register' => false]);

// Return profile view
Route::get('/profile', 'ProfileController@show')->name('profile');

// Make post request for editing the user's profile
Route::post('/profile', 'ProfileController@update');

