<?php
Route::group(['prefix' => 'authority'], function () {
    Route::group(['middleware' => ['admins']], function () {
<<<<<<< HEAD
				// Added from component controller
				Route::get('block/add', 'AdminControllers\BlockController@initContentCreate');
				Route::post('block/add', 'AdminControllers\BlockController@initProcessCreate');
				Route::get('block/edit/{id}', 'AdminControllers\BlockController@initContentCreate');
				Route::post('block/edit/{id}', 'AdminControllers\BlockController@initProcessCreate');
				Route::get('block', 'AdminControllers\BlockController@initListing');
				Route::get('block/delete/{id}', 'AdminControllers@initProcessDelete');

        //Table
        Route::get('tables', 'AdminControllers\TableController@initListing');
        Route::get('table/add', 'AdminControllers\TableController@initContentAdd');
        Route::post('table/add', 'AdminControllers\TableController@initProcessAdd');
        Route::get('table/{table_name}', 'AdminControllers\TableController@initContentTable');

        //Configuration
        Route::get('configuration', 'AdminControllers\ConfigurationController@initContentCreate');
        Route::post('configuration', 'AdminControllers\ConfigurationController@initProcessCreate');

        //Clear Cache
        Route::get('clear/cache', 'AdminControllers\ConfigurationController@initProcessClearCache');

        //Component
        Route::get('component/create', 'AdminControllers\ComponentController@initContentCreate');
        Route::post('component/create', 'AdminControllers\ComponentController@initProcessCreate');
        Route::get('component/edit/{id}', 'AdminControllers\ComponentController@initContentCreate');
        Route::post('component/edit/{id}', 'AdminControllers\ComponentController@initProcessCreate');
        Route::get('component/list', 'AdminControllers\ComponentController@initListing');

        Route::get('component/fields/create/{id_component}', 'AdminControllers\ComponentController@initContentCreateFields');
        Route::post('component/fields/create/{id_component}', 'AdminControllers\ComponentController@initContentCreateFields');

        //Media
        Route::get('media', 'AdminControllers\MediaController@initListing');
        Route::post('media', 'AdminControllers\MediaController@initCreating');
        Route::post('media/save/embeded', 'AdminControllers\MediaController@initCreatingSaveEmbeded');
        Route::post('media/save/cropped/{id_media}', 'AdminControllers\MediaController@initCreatingSaveCropped');
        Route::post('media/save/{id_media}', 'AdminControllers\MediaController@initCreatingSave');
        Route::get('media/library', 'AdminControllers\MediaController@initGetLibrary');
        Route::get('media/library/{type}', 'AdminControllers\MediaController@initGetLibrary');
        Route::get('media/delete/{id_media}', 'AdminControllers\MediaController@initDeleting');
=======
      Route::get('dashboard', 'AdminControllers\DashboardController@initContent');
      Route::get('employee/list', 'AdminControllers\EmployeeController@initListing');

      //COnfiguration
      Route::get('configuration', 'AdminControllers\ConfigurationController@initContentCreate');
      Route::post('configuration', 'AdminControllers\ConfigurationController@initProcessCreate');

      //Clear Cache
      Route::get('clear/cache', 'AdminControllers\ConfigurationController@initClearCache');

      //Media
      Route::get('media', 'AdminControllers\MediaController@initListing');
      Route::post('media', 'AdminControllers\MediaController@initCreating');
      Route::post('media/save/embeded', 'AdminControllers\MediaController@initCreatingSaveEmbeded');
      Route::post('media/save/cropped/{id_media}', 'AdminControllers\MediaController@initCreatingSaveCropped');
      Route::post('media/save/{id_media}', 'AdminControllers\MediaController@initCreatingSave');
      Route::get('media/library', 'AdminControllers\MediaController@initGetLibrary');
      Route::get('media/library/{type}/{object_type}', 'AdminControllers\MediaController@initGetLibrary');
      Route::get('media/delete/{id_media}', 'AdminControllers\MediaController@initDeleting');

>>>>>>> 893181fa759adf1e3540f458fe418bbad3dc6810
    });

    Route::get('login', 'AdminControllers\LoginController@initContent');
    Route::post('login', 'AdminControllers\LoginController@login');
    Route::get('logout', 'AdminControllers\LoginController@logout');

    Route::get('employee/create', 'AdminControllers\EmployeeController@initContentCreate');
    Route::post('employee/create', 'AdminControllers\EmployeeController@initProcessCreate');
    Route::get('employee/edit/{id}', 'AdminControllers\EmployeeController@initContentCreate');
    Route::post('employee/edit/{id}', 'AdminControllers\EmployeeController@initProcessCreate');
});
