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
Route::group(['domain' => 'admin.' . config('app.domain'), 'namespace' => 'Admin'], function ()
{

//	dd(config('app.domain'));

	Route::group(['middleware' => config('admin.filter.guest')], function ()
	{
		Route::resource('login', '\Pingpong\Admin\Controllers\LoginController', [
			'only' => ['index', 'store'],
			'names' => [
				'index' => 'admin.login.index',
				'store' => 'admin.login.store',
			],
		]);
	});

	Route::group(['middleware' => config('admin.filter.auth')], function ()
	{
		Route::get('/', ['as' => 'admin.home', 'uses' => '\Pingpong\Admin\Controllers\SiteController@index']);
		Route::get('/admin-backend', ['as' => 'admin.home', 'uses' => '\Pingpong\Admin\Controllers\SiteController@index']);
		Route::get('/logout', ['as' => 'admin.logout', 'uses' => '\Pingpong\Admin\Controllers\SiteController@logout']);

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
		Route::post('user/send-message', 'UsersController@postSendMessage');

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

		Route::resource('pages', 'PagesController', [
			'names' => [
				'index' => 'admin.pages.index',
				'create' => 'admin.pages.create',
				'store' => 'admin.pages.store',
				'show' => 'admin.pages.show',
				'update' => 'admin.pages.update',
				'edit' => 'admin.pages.edit',
				'destroy' => 'admin.pages.destroy',
			],
		]);

		Route::resource('users', 'UsersController', [
			'names' => [
				'index' => 'admin.users.index',
				'create' => 'admin.users.create',
				'store' => 'admin.users.store',
				'show' => 'admin.users.show',
				'update' => 'admin.users.update',
				'edit' => 'admin.users.edit',
				'destroy' => 'admin.users.destroy',
			],
		]);
		Route::resource('categories', '\Pingpong\Admin\Controllers\CategoriesController', [
			'except' => 'show',
			'names' => [
				'index' => 'admin.categories.index',
				'create' => 'admin.categories.create',
				'store' => 'admin.categories.store',
				'show' => 'admin.categories.show',
				'update' => 'admin.categories.update',
				'edit' => 'admin.categories.edit',
				'destroy' => 'admin.categories.destroy',
			],
		]);

		Route::resource('payments', 'PaymentsController', [
			'only' => ['show', 'index'],
			'names' => [
				'index' => 'admin.payments.index',
				'show' => 'admin.payments.show',
			],
		]);
	});

});


/*front*/

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');


Route::controllers([
	'auth'     => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
get('email/confirm/{token}', 'Auth\EmailController@getConfirm');


Route::get('profile/{id}', 'ProfileController@showProfile');
Route::controllers([
	'profile'     => 'ProfileController',
]);


Route::group(['middleware' => 'auth', 'prefix' => 'user', 'namespace' => 'User'], function()
{
	Route::resource('projects', 'ProjectsController');

	Route::get('settings', 'SettingsController@index');
	Route::controllers([
		'settings'     => 'SettingsController',
	]);
});

Route::get('projects/list', 'ProjectsController@getList');
Route::resource('projects', 'ProjectsController');


/* Display page */
Route::get('{page}', 'PagesController@show');


Route::group(['middleware' => 'auth'], function()
{
	Route::resource('payments', 'PaymentsController');
	// Add this route for checkout or submit form to pass the item into paypal
	Route::post('payment', array(
		'as' => 'payment',
		'uses' => 'PaymentsController@postPayment',
	));
	// this is after make the payment, PayPal redirect back to your site
	Route::get('payment/status', array(
		'as' => 'payment.status',
		'uses' => 'PaymentsController@getPaymentStatus',
	));

	Route::resource('comments', 'CommentsController');
});