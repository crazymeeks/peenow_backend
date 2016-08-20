<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['prefix' => 'api'], function(){
	// RESTful API
	Route::resource('areas', 'Api\AreasController');
});


/**
 * API calls
 *
 * Get all list of available location within the given latlng
 * pee.storyteching.ph/api/areas/{lat,lng}
 *
 * Save new area - This must a post method
 * pee.storyteching.ph/api/areas
 *
 */


Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
