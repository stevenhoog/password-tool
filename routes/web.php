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
Route::get('/', 'GroupsController@index');

// Disable register route
Auth::Routes(['register' => false]);

// Return view for creating a group
Route::get('/group', 'GroupsController@add');
// Make post request for creating a group
Route::post('/group', 'GroupsController@create');

// Return view for editing a group
Route::get('/group/{group}', 'GroupsController@edit');
// Make post request for editing/deleting a group
Route::post('/group/{group}', 'GroupsController@update');

