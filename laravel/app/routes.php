<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/debug', function() {
    Session::flash('message', 'debug route');
    return View::make('admin.login');
});

Route::get('/', array('as' => 'index', 'uses' => 'ProvocationsController@index'));

Route::post('/login', array('as' => 'login', 'uses' => 'UsersController@login'));
Route::post('/admin', array('uses' => 'UsersController@login'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));
Route::get('/admin', array('as' => 'admin', 'uses' => 'UsersController@dashboard'));

Route::get('/submit', array('as' => 'submit', 'uses' => 'ProvocationController@create'));
Route::post('/submit', array('uses' => 'ProvocationController@store'));
