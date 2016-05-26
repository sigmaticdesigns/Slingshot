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

/*admin panel*/
Route::group(['prefix' => config('admin.prefix', 'admin'), 'namespace' => 'Admin'], function () {

	Route::group(['middleware' => config('admin.filter.guest')], function ()
	{
		Route::get('/', function () {
			return view('welcome');
		});

		Route::resource('login', '\Pingpong\Admin\Controllers\LoginController', [
			'only' => ['index', 'store'],
			'names' => [
				'index' => 'admin.login.index',
				'store' => 'admin.login.store',
			],
		]);
	});

	Route::group(['middleware' => config('admin.filter.admin')], function () {
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

		Route::post('project/set-status', 'ProjectsController@postSetStatus');
		Route::post('user/set-status', 'UsersController@postSetStatus');

		Route::resource('letters', 'LettersController', [
			'names' => [
				'index' => 'admin.letters.index',
				'create' => 'admin.letters.create',
				'store' => 'admin.letters.store',
				'show' => 'admin.letters.show',
				'update' => 'admin.letters.update',
				'edit' => 'admin.letters.edit',
				'destroy' => 'admin.letters.destroy',
			],
		]);
	});

});


/*front*/

Route::get('/', 'HomeController@index');

Route::get('/home', function () {
	return view('home');
});


Route::controllers([
	'auth'     => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::get('profile/{id}', 'ProfileController@showProfile');
Route::controllers([
	'profile'     => 'ProfileController',
]);


Route::group(['middleware' => 'auth'], function()
{
	Route::get('settings', 'SettingsController@index');
	Route::controllers([
		'settings'     => 'SettingsController',
	]);
	Route::resource('projects', 'ProjectsController');
});

Route::group(['middleware' => 'auth', 'prefix' => 'user', 'namespace' => 'User'], function()
{
	Route::resource('projects', 'ProjectsController');
});

/* Display page */
Route::get('{page}', 'PagesController@show');
