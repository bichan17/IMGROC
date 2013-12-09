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
use Illuminate\Database\Eloquent\ModelNotFoundException;

Route::get('/debug', function() {
    Session::flash('message', 'debug route');
    return View::make('admin.login');
});

Route::get('/', array('as' => 'index', 'uses' => 'ProvocationsController@index'));

Route::any('/login', array('as' => 'login', 'uses' => 'UsersController@login'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));

Route::group(array('prefix' => '/admin', 'before' => 'auth'), function()
{
    Route::get('/', array('as' => 'admin', 'uses' => 'UsersController@dashboard'));
    Route::post('/', array('uses' => 'UsersController@login'));

    Route::get('/moderate', array('as' => 'modqueue', 'uses' => 'ProvocationsController@modqueue'));
    Route::post('/moderate', array('uses' => 'ProvocationsController@editprov'));

    Route::get('/provocations', array('as' => 'allprovs', 'uses' => 'ProvocationsController@allprovs'));
    Route::post('/provocations', array('uses' => 'ProvocationsController@editprov'));
    
    Route::get('/provocations/trashed', array('as' => 'trashedprovs', 'uses' => 'ProvocationsController@trashedprovs'));
    Route::post('/provocations/trashed', array('uses' => 'ProvocationsController@editprov'));

    Route::get('/account', array('as' => 'account', 'uses' => 'UsersController@account'));
    Route::post('/account', array('as' => 'editaccount', 'uses' => 'UsersController@editaccount'));

    Route::get('/users', array('as' => 'users', 'uses' => 'UsersController@users'));
    Route::post('/users', array('uses' => 'UsersController@editusers'));

    Route::get('/users/add', array('as' => 'adduser', 'uses' => 'UsersController@adduser'));
    Route::post('/users/add', array('uses' => 'UsersController@editaccount'));
});

Route::get('/submit', array('as' => 'submit', 'uses' => 'ProvocationController@create'));
Route::post('/submit', array('uses' => 'ProvocationController@store'));

App::error(function(ModelNotFoundException $e) {
    Session::flash('message', 'This provocation or user was not found');
    return Redirect::route('index');
});
