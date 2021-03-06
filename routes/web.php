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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/** 路由权限限定 */
// Entrust::routeNeedsPermission('admin/*', ['super_manager',]);
// Entrust::routeNeedsRole('admin/*', ['admin',]);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index');

    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('department', 'DepartmentController');

    Route::get('logs/{page?}', 'LogController@index');

    Route::get('u-disk/{page?}', 'UDiskController@index');
    Route::any('u-disk/store', 'UDiskController@store');
    Route::any('u-disk/update/{id?}', 'UDiskController@update');
    Route::any('u-disk/destroy/{id?}', 'UDiskController@destroy');

});

Route::group(['prefix' => 'test',], function () {
    Route::get('/', 'TestController@index');
});
