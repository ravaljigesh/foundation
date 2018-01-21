<?php
Route::group(['prefix' => 'authority'], function () {
    Route::group(['middleware' => ['admins']], function () {
      Route::get('dashboard', 'AdminControllers\DashboardController@initContent');
      Route::get('employee/list', 'AdminControllers\EmployeeController@initListing');
    });

    Route::get('login', 'AdminControllers\LoginController@initContent');
    Route::post('login', 'AdminControllers\LoginController@login');
    Route::get('logout', 'AdminControllers\LoginController@logout');

    Route::get('employee/create', 'AdminControllers\EmployeeController@initCreate');
    Route::post('employee/create', 'AdminControllers\EmployeeController@initProcessCreate');
    Route::get('employee/edit/{id}', 'AdminControllers\EmployeeController@initCreate');
    Route::post('employee/edit/{id}', 'AdminControllers\EmployeeController@initProcessCreate');
});
