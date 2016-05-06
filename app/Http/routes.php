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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
	return view('home');
});


Route::controllers([
	'auth'     => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => config('admin.prefix', 'admin'), 'namespace' => 'Admin'], function () {

	Route::group(['middleware' => config('admin.filter.auth')], function () {
		Route::resource('projects', 'ProjectsController', [
			'names' => [
				'index' => 'admin.projects.index',
				'create' => 'admin.projects.create',
				'store' => 'admin.projects.store',
				'show' => 'admin.projects.show',
				'update' => 'admin.projects.update',
				'edit' => 'admin.projects.edit',
				'destroy' => 'admin.projects.destroy',
			],
		]);
	});

});