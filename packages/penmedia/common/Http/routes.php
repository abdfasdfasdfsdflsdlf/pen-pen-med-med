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

$route_namespace = config('penguin.homenamespace');

Route::group([
    'namespace'  => $route_namespace,
    'as'		 => "",
], function () {
	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index');
});
