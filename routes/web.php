<?php

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
Route::group(['middleware' => 'language'], function () {
  Route::get('r', function () {
    return 'here we are';
  });
  Route::get('/', 'FrontControllers\UserController@initContent');

  Route::get('/home', 'FrontControllers\UserController@initContent');

  // Authentication Routes...
  Route::get('/login', 'FrontControllers\LoginController@showLoginForm')->name('login');
  Route::post('login', 'FrontControllers\LoginController@login');
  Route::get('logout', 'FrontControllers\LoginController@logout');

  // Registration Routes...
  Route::get('/register', 'FrontControllers\RegisterController@showRegistrationForm');
  Route::post('register', 'FrontControllers\RegisterController@register');

  // Password Reset Routes...
  Route::get('password/reset/{token?}', 'FrontControllers\ResetPasswordController@showResetForm');
  Route::post('password/email', 'FrontControllers\ResetPasswordController@sendResetLinkEmail');
  Route::post('password/reset', 'FrontControllers\ResetPasswordController@reset');

  Route::group(['prefix' => 'authority'], function () {
    Route::group(['middleware' => ['admins']], function () {
      Route::get('dashboard', 'AdminControllers\DashboardController@initContent');
    });

    Route::get('login', 'AdminControllers\LoginController@initContent');
    Route::post('login', 'AdminControllers\LoginController@login');
    Route::get('logout', 'AdminControllers\LoginController@logout');

    Route::get('employee/create', 'AdminControllers\EmployeeController@initCreate');
    Route::post('employee/create', 'AdminControllers\EmployeeController@register');
  });

  Route::get('test', 'FrontControllers\TestController@initContent');
});
