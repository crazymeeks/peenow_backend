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
	Route::post('save-area', 'Api\AreasController@saveArea');
});

// Route::get('/{q}', function($q){
// 	$handle = fopen("http://maps.google.com/maps/geo?q=".urlencode($q)."&sensor=false&oe=utf8&gl=en&output=csv&key=AIzaSyBg0YHs4oxJr0jAr2qg-qzTpZEAggsEzZk","r");

// 		$data = fgetcsv($handle);
// 		return $data;
// });
//Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
