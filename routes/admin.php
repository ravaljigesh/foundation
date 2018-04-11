<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'authority'], function () {
  Route::group(['middleware' => 'admin'], function () {
    Route::get('/', function () {
      return 'Authority section';
    });
  });
  Route::get('secure/challenge', function () {
    return 'login screen';
  });
});
